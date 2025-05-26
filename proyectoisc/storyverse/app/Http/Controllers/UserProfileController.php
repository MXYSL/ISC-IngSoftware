<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Mostrar perfil de usuario
    public function show()
    {
        return view('profile.show');
    }

    // Mostrar panel de administración
    public function panel()
    {
        // Si necesitas pasar usuarios a la vista, puedes hacerlo así:
        $users = User::with('role')->get();
        return view('profile.panel', compact('users'));
    }

    // Actualizar perfil propio
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
        ]);

        $data = [
            'username' => $validated['username'],
            'email' => $validated['email'],
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        return redirect()->back()->with('success', 'Perfil actualizado correctamente.');
    }

    // Actualizar imagen de perfil
    public function updateImage(Request $request)
    {
        $request->validate([
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        $user = Auth::user();

        if ($user->imagen) {
            Storage::disk('public')->delete('profile_images/' . $user->imagen);
        }

        $image = $request->file('imagen');
        $filename = uniqid('profile_') . '.' . $image->getClientOriginalExtension();

        // Usa el driver GD con el namespace completo
        $manager = new ImageManager(\Intervention\Image\Drivers\Gd\Driver::class);
        $img = $manager->read($image);
        $img = $img->resize(300, 300);
        $img->toJpeg()->save(storage_path('app/public/profile_images/' . $filename));

        $user->update(['imagen' => $filename]);

        return redirect()->back()->with('success', 'Imagen actualizada correctamente.');
    }

    // Eliminar imagen de perfil
    public function deleteImage()
    {
        $user = Auth::user();

        if ($user->imagen) {
            Storage::disk('public')->delete('profile_images/' . $user->imagen);
            $user->update(['imagen' => null]);
        }

        return redirect()->back()->with('success', 'Imagen eliminada correctamente.');
    }

    // Guardar nuevo usuario (desde panel admin)
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'role_id' => 'required|in:1,2',
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = $request->role_id;

        if ($request->hasFile('profile_photo')) {
            $user->profile_photo_path = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        $user->save();

        return redirect()->route('profile.panel')->with('success', 'Usuario creado correctamente.');
    }

    // Mostrar formulario de edición (AJAX)
    public function edit(User $user)
    {
        $roleValue = $user->role->name ?? '';
        $isSelf = auth()->id() === $user->id;

        $html = '
        <form action="'.route('profile.update', $user).'" method="POST" enctype="multipart/form-data">
            '.csrf_field().method_field('PUT').'
            <label>Usuario</label>
            <input type="text" name="username" value="'.e($user->username).'" required>
            <label>Email</label>
            <input type="email" name="email" value="'.e($user->email).'" required>
            <label>Nueva contraseña</label>
            <input type="password" name="password" placeholder="Nueva contraseña (opcional)">
            <input type="password" name="password_confirmation" placeholder="Confirmar contraseña">
            <label>Foto de perfil</label>
            <input type="file" name="profile_photo">
            <label>Rol</label>
            <select name="role_id" '.($isSelf ? 'disabled' : '').'>
                <option value="1" '.($user->role_id == 1 ? 'selected' : '').'>Administrador</option>
                <option value="2" '.($user->role_id == 2 ? 'selected' : '').'>Usuario</option>
            </select>
            <br>
            <button type="submit">Actualizar</button>
            <button type="button" onclick="document.getElementById(\'view-modal\').style.display=\'none\'">Cancelar</button>
            '.($isSelf ? '<br><small>No puedes cambiar tu propio rol.</small>' : '').'
        </form>';

        return response($html);
    }

    // Actualizar usuario (desde panel admin)
    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|confirmed|min:6',
            'role_id' => 'required|in:1,2',
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        $user->username = $request->username;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        // Solo permite cambiar el rol si NO es el usuario autenticado
        if (auth()->id() !== $user->id) {
            $user->role_id = $request->role_id;
        }
        if ($request->hasFile('profile_photo')) {
            $user->profile_photo_path = $request->file('profile_photo')->store('profile-photos', 'public');
        }
        $user->save();

        return redirect()->route('profile.panel')->with('success', 'Usuario actualizado correctamente.');
    }

    // Eliminar usuario (desde panel admin)
    public function destroy(User $user)
    {
        $authUser = auth()->user();

        // No puede autoeliminarse
        if ($authUser->id === $user->id) {
            return redirect()->route('profile.panel')->with('error', 'No puedes eliminar tu propio usuario.');
        }

        $user->delete();

        return redirect()->route('profile.panel')->with('success', 'Usuario eliminado correctamente.');
    }

    // Buscar usuario por nombre (AJAX)
    public function search(Request $request)
    {
        $user = User::where('username', $request->name)->first();

        if (!$user) {
            return response()->json(null);
        }

        // Si tienes relación: User belongsTo Role
        $role = $user->role->name ?? '';

        return response()->json([
            'id'    => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'role'  => $role,
        ]);
    }
}
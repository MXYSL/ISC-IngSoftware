<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    // Obtener favoritos del usuario autenticado
    public function index(Request $request)
    {
        return Favorite::where('user_id', $request->user()->id)->get();
    }

    // Agregar a favoritos
    public function store(Request $request)
    {
        $fav = new Favorite($request->all());
        $fav->user_id = $request->user()->id;
        $fav->save();
        return response()->json($fav, 201);
    }

    // Eliminar de favoritos
    public function destroy(Request $request, $id)
    {
        $fav = Favorite::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();
        $fav->delete();
        return response()->json(['success' => true]);
    }
}
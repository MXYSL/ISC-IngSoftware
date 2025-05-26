<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'role_id',
        'imagen',
        'tema',
        'provider',
        'provider_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    public function isAdmin()
    {
        return $this->role_id == 1;
    }
    
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    
    public function getImagenUrlAttribute()
    {
        if ($this->imagen) {
            return asset('storage/profile_images/' . $this->imagen);
        } else {
            return asset('img/default-profile.png');
        }
    }
}
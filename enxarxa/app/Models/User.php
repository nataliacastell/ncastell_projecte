<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nombre',
        'correo_electronico',
        'contrasena',
    ];

    protected $hidden = [
        'contrasena',
        'remember_token',
    ];

    public function scopeSearch($query, $term)
    {
        if ($term) {
            $query->where('nombre', 'LIKE', '%' . $term . '%')
                ->orWhere('correo_electronico', 'LIKE', '%' . $term . '%');
        }
        return $query;
    }
}

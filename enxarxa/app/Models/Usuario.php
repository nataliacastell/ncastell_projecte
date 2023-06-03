<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'correo_electronico',
        'contrasena',
        'tipo_usuario'
    ];

    /**
     * Get the publicaciones of the usuario.
     */
    public function publicaciones()
    {
        return $this->hasMany(Publicacion::class, 'usuario_id');
    }

    /**
     * Get the followers of the usuario.
     */
    public function followers()
    {
        return $this->belongsToMany(Usuario::class, 'follows', 'following_id', 'follower_id');
    }

    /**
     * Get the following usuarios of the usuario.
     */
    public function following()
    {
        return $this->belongsToMany(Usuario::class, 'follows', 'follower_id', 'following_id');
    }
}

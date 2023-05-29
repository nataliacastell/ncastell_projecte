<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Usuario
 *
 * @property int $id
 * @property string $nombre
 * @property string $correo_electronico
 * @property string $contrasena
 * @property string $tipo_usuario
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Usuario> $followers
 * @property-read int|null $followers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Usuario> $following
 * @property-read int|null $following_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Publicacion> $publicaciones
 * @property-read int|null $publicaciones_count
 * @method static \Database\Factories\UsuarioFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario query()
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario whereContrasena($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario whereCorreoElectronico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario whereTipoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
        'tipo_usuario',
        'fecha_creacion',
        'fecha_modificacion',
        'eliminado',
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;

/**
 * App\Models\Publicacion
 *
 * @property-read Usuario|null $usuario
 * @method static \Database\Factories\PublicacionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Publicacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Publicacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Publicacion query()
 * @mixin \Eloquent
 */
class Publicacion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'texto',
        'imagen',
        'likes',
    ];

    /**
     * Get the usuario that owns the publicacion.
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}

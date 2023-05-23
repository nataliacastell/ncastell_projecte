<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;

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

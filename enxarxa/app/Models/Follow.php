<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Usuario;

class Follow extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'usuario1_id',
        'usuario2_id',
        'fecha_creacion',
        'fecha_modificacion',
        'eliminado',
    ];

    /**
     * Get the follower user.
     */
    public function follower()
    {
        return $this->belongsTo(Usuario::class, 'usuario1_id');
    }

    /**
     * Get the following user.
     */
    public function following()
    {
        return $this->belongsTo(Usuario::class, 'usuario2_id');
    }
}

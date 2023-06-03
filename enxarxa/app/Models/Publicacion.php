<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publicacion extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'publicaciones';

    protected $fillable = [
        'usuario_id',
        'texto',
        'imagen',
        'likes'
    ];

    protected $dates = ['deleted_at'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}

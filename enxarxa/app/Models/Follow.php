<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Usuario;

/**
 * App\Models\Follow
 *
 * @property int $id
 * @property int $follower_id
 * @property int $following_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read Usuario|null $follower
 * @property-read Usuario|null $following
 * @method static \Database\Factories\FollowFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Follow newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Follow newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Follow onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Follow query()
 * @method static \Illuminate\Database\Eloquent\Builder|Follow whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Follow whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Follow whereFollowerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Follow whereFollowingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Follow whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Follow whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Follow withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Follow withoutTrashed()
 * @mixin \Eloquent
 */
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

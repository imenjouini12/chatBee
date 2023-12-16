<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Comment
 * 
 * @package App\Models
 * 
 * @property int $id
 * @property int $user_id
 * @property int $post_id
 * @property string $content 
 * 
 * @property User $user
 * @property Post $post
 */

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['content'];
    /**
     * Relation avec l'utilisateur (Auteur)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user():BelongsTo{
        return $this->belongsTo(User::class);

    }
    
    /**
     * Relation avec la publication
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post():BelongsTo{
        return $this->belongsTo(Post::class);

    }
}

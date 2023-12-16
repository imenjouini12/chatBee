<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/** 
* Class Post
* 
* @package App\Models
*
* @property int $id
* @property int $user_id
* @property string $title
* @property string $content
* @property \Illuminate\Support\Carbon $created_at
* @property \Illuminate\Support\Carbon $updated_at

* @property User $user
* @property Comment[] $comments
*/

class Post extends Model
{
    use HasFactory;
    /**
     * les attributs de la class
     * @var array
     */

    protected $fillable = ['title','content'];

    /**
     * Relation avec l'utilisateur (Auteur)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User():BelongsTo{

        return $this->belongTo(User::class);
    }

    /**
     * Relation avec les commentaires
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments():HasMany{

        return $this->hasMany(Comment::class);
    }

}

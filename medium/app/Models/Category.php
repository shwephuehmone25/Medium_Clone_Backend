<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $fillable = ['name'];

    /**
     * The post that belong to the categories.
     */
    public function posts()
    {

        return $this->belongsToMany(Post::class, 'posts_categories', 'category_id', 'post_id');
    }

    /**
     * Get the user that owns the post.
     */
    public function user()
    {

        return $this->belongsTo(User::class);
    }
}
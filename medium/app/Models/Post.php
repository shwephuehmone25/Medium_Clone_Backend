<?php

namespace App\Models;

use App\Contracts\Likeable;
use App\Models\Category;
use App\Models\Concerns\Likes;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model implements Likeable
{
    use HasFactory, SoftDeletes, Likes;

    public $fillable = ['user_id', 'image', 'title', 'description'];
    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the user that owns the post.
     */
    public function user()
    {

        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that owns the post.
     */
    public function categories()
    {

        return $this->belongsToMany(Category::class, 'posts_categories', 'post_id', 'category_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    /**
     * Search posts by title.
     */
    public function scopeFilter($query, $search)
    {

        return $query->when($search ?? false, function ($query, $search) {
            $query->where('title', 'LIKE', '%' . $search . '%');
        });
    }
}
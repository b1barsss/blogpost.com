<?php

namespace App\Models;

use App\Scopes\DeletedAdminScope;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class BlogPost extends Model
{
    use HasFactory;
//    protected $table = "blogposts";
    use SoftDeletes;


    protected $fillable = [
        'title',
        'content',
        'user_id'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeMostCommented(Builder $query)
    {
        return $query->withCount('comments')->orderBy('comments_count', 'desc');
    }

    public function scopeLatestWithRelations(Builder $query)
    {
        return $query->latest()
            ->withCount('comments')
            ->with(['user','tags']);

    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public static function boot()
    {
        static::addGlobalScope(new DeletedAdminScope);

        parent::boot();

        static::updating(function (BlogPost $blogPost)
            {
                Cache::tags(['blog-post'])->forget("blog-post-$blogPost->id");
            });

        static::deleting(function (BlogPost $blogPost)
            {
                $blogPost->comments()->delete();
                Cache::tags(['blog-post'])->forget("blog-post-$blogPost->id");
            });

        static::restoring(function (BlogPost $blogPost)
            {
                Cache::tags(['blog-post'])->forget("blog-post-$blogPost->id");
                $blogPost->comments()->restore();
            }
        );

    }

}

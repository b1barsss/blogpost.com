<?php

namespace App\Models;

use App\Scopes\LatestScope;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public static function boot()
    {
        parent::boot();


        static::deleting(
            function (BlogPost $blogPost)
            {
                $blogPost->comments()->delete();
            });

        static::restoring(
            function (BlogPost $blogPost)
            {
                $blogPost->comments()->restore();
            }
        );

    }

}

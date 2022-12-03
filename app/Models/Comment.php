<?php

namespace App\Models;

//use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function blogPost() // naming for blog_post_id
    {
        return $this->belongsTo(BlogPost::class);
        //  return $this->belongsTo(BlogPost::class, 'post_id', 'blog_post_id'); post_id if foreign key is post_id

    }



    public static function boot()
    {
        parent::boot();

    }
}

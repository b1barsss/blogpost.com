<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public function blogPost() // naming for blog_post_id
    {
        return $this->belongsTo(BlogPost::class);
        //  return $this->belongsTo(BlogPost::class, 'post_id', 'blog_post_id'); post_id if foreign key is post_id

    }
}

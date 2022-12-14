<?php

namespace App\Models;

use App\Traits\Taggable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes, Taggable;

    protected $fillable = [
        'user_id',
        'content',
    ];

    protected $hidden = [
        'deleted_at',
        'commentable_type',
        'commentable_id',
        'user_id',
    ];

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

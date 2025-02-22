<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Posts extends Model
{
    /** @use HasFactory<\Database\Factories\PostsFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'title',
        'body'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

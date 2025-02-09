<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebBlog extends Model
{

    use HasFactory;

    protected $table = 'web_blogs';

    protected $fillable = [
        'title',
        'content',
        'author',
        'image'
    ];
}

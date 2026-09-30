<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Bonus

class Post extends Model
{
    use HasFactory, SoftDeletes; // Bonus

    protected $fillable = ['title', 'content', 'image'];
}
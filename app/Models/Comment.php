<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'blog_id',
        'name',
        'email',
        'comment',
    ];
    public function blog()
        {
            return $this->belongsTo(blog::class,); 
        }
        public function patient()
        {
            return $this->belongsTo(User::class, 'user_id'); 
        }
}

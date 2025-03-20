<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstagramDetail extends Model
{
    use HasFactory;
    protected $fillable = [
                'user_id',
                'username' ,
                'full_name' ,
                'profile_picture',
                'bio' ,
                'followers_count' ,
                'following_count' ,
    ];
}

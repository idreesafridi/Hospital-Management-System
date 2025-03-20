<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory; use SoftDeletes;
    protected $fillable = [
        'user_id',
        'category_id',
          'title',
          'description',
          'status' ,
         
          ];

    public function blogAttachments()
    {
        return $this->hasMany(BlogAttachment::class,'blog_id');
    }
    public function blogAttachment()
    {
        return $this->hasOne(BlogAttachment::class,'blog_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function blogTag()
    {
        return $this->hasMany(BlogTag::class,'blog_id');
    }
    public function tags()
    {
        return $this->belongsToMany(BlogTag::class);
    }
    public function doctorblogs()
        {
            return $this->belongsTo(User::class, 'user_id'); 
        }
        public function comments()
        {
            return $this->hasMany(Comment::class,'blog_id');
        }
       
}

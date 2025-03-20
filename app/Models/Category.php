<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory; use SoftDeletes;

    protected $fillable = [
        'parent_category_id',
        'name', 
        'status',
        'file',
        
    ];
    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_category_id');
    }

    // Optionally, define the relationship to get all child categories (in case you need it)
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_category_id');
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}

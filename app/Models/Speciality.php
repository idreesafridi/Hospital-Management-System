<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Speciality extends Model
{
    use HasFactory;   use SoftDeletes;
    protected $fillable = [
        'parent_id','name', 'file','status',
    ];

    public function parentSpeciality()
    {
        return $this->belongsTo(Speciality::class, 'parent_id');
    }

    // Optionally, define the relationship to get all child categories (in case you need it)
    public function children()
    {
        return $this->hasMany(Speciality::class, 'parent_id');
    }

    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }

}

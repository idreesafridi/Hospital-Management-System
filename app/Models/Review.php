<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory; use SoftDeletes;

    protected $fillable = [
        'title',
        'review',
        'doctor_id',
        'user_id',
        'rating',
        'term',
        'status',
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id'); 
    }
      
    public function patient()
    {
       return $this->belongsTo(User::class, 'user_id'); 
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'educations';

    protected $fillable = [
        'doctor_id',
        'university'  ,
        'degree'  ,
        'start_date',
        'end_date',
    ];
    //education model
    public function user()
        {
            return $this->belongsTo(User::class, 'doctor_id');
        }
    
}

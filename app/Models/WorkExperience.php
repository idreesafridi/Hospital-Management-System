<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkExperience extends Model
{
    use HasFactory;
    protected $table = 'work_experiences';

    protected $fillable = [
        'doctor_id',
        'hospital',
        'start_date',
        'end_date',
    ];
    public function user()
        {
            return $this->belongsTo(User::class, 'doctor_id');
        }
}

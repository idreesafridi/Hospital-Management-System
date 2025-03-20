<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'disease',
        'appointment_time',
        'appointment_date',
        'status',
    ];
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id'); 
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id'); 
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'appointment_id');
    }

}

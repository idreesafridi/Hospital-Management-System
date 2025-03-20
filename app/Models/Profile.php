<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','speciality_id', 'profile_image','address','phone_number','about',
    ];

    //profile model
    public function user()
        {
            return $this->belongsTo(User::class, 'user_id'); 
        }


    public function speciality()
    {
        return $this->belongsTo(Speciality::class, 'speciality_id');
    }


}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

      // user model

        public function isAdmin()
        {
            return $this->role === 'Admin';
        }


        public function isDoctor()
        {
            return $this->role === 'Doctor';
        }

        // Check if the user is a patient
        public function isPatient()
        {
            return $this->role === 'Patient';
        }

        public function profile()
        {
            return $this->hasOne(Profile::class,'user_id');
        }

        public function education()
        {
            return $this->hasMany(Education::class, 'doctor_id'); 
        }
        public function work()
        {
            return $this->hasMany(WorkExperience::class, 'doctor_id'); 
        }
        public function doctorfiles()
        {
            return $this->hasMany(DoctorAttachment::class, 'doctor_id'); 
        }
        public function doctorappointments()
        {
            return $this->hasMany(Appointment::class, 'doctor_id'); 
        }
        public function patientappointments()
        {
            return $this->hasMany(Appointment::class, 'patient_id'); 
        }
        public function reviewdoctor()
        {
            return $this->hasMany(Review::class, 'doctor_id'); 
        }
        public function reviewpatient()
        {
            return $this->hasMany(Review::class, 'user_id'); 
        }
        public function doctorblogs()
        {
            return $this->hasMany(Blog::class, 'user_id'); 
        }
        public function patientcomments()
        {
            return $this->hasMany(User::class, 'user_id'); 
        }

        

      
}

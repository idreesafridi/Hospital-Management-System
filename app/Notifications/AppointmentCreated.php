<?php

namespace App\Notifications;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class AppointmentCreated extends Notification
{
    use Queueable;

    protected $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function via($notifiable)
    {
        return ['database'];  
    }

   public function toDatabase($notifiable)
{
    return [
        'message' => "You have a new appointment with " . $this->appointment->patient->name . 
                     ' on ' . $this->appointment->appointment_date . ' at ' . $this->appointment->appointment_time,
        'patient_name' => $this->appointment->patient->name,
        // 'patient_image'=> $this->appointment->patient->profile->profile_image ,
        'doctor_name' => $this->appointment->doctor->name,
        'appointment_time' => $this->appointment->appointment_time,
        'appointment_date' => $this->appointment->appointment_date,
    ];
}

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('New Appointment Booking')
                    ->line('You have a new appointment with patient ' . $this->appointment->patient->name)
                    ->line('Appointment Date: ' . $this->appointment->appointment_date)
                    ->line('Appointment Time: ' . $this->appointment->appointment_time)
                    ->action('View Appointment', url('/appointments/'.$this->appointment->id));
    }
}

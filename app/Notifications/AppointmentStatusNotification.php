<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AppointmentStatusNotification extends Notification
{
    use Queueable;

    private $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $message = (new MailMessage)
                    ->line('Your appointment has been ' . $this->status . '.')
                    ->action('View Appointments', url('/client/appointments'))
                    ->line('Thank you for using our application!');

        if ($notifiable->isAdmin()) {
            $message->line('This appointment has been ' . $this->status . ' by a mechanic.');
        }

        return $message;
    }
}
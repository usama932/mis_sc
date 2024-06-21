<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class ActivityDeadlineNotification extends Notification
{
    use Queueable;

    protected $month;

    public function __construct($month)
    {
        $this->month = $month;
    }

    public function via($notifiable)
    {
        return [ 'broadcast'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The deadline for the following activity is the day after tomorrow:')
            ->line($this->month->name)
            ->action('View Project Activity', url('/activity_dips/'.$this->month->activity->id))
            ->line('Thank you for using our application!');
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message' => 'The deadline for the activity "'.$this->month->activity->name.'" is the day after tomorrow.'
        ]);
    }

    public function toArray($notifiable)
    {
        return [
            'activity_id' => $this->month->activity->id,
            'message' => 'The deadline for the activity "'.$this->month->activity->name.'" is the day after tomorrow.'
        ];
    }
}

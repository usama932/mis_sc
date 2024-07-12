<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class ActivityDeadlineNotification extends Notification implements ShouldQueue
{
    use Queueable;
    protected $activity;

    public function __construct($activity)
    {
        $this->activity = $activity;
    }


    public function via(object $notifiable): array
    {
        return [ 'broadcast','mail','database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Activity Deadline Approaching')
            ->line('The deadline for the activity "' . $this->activity->name . '" is approaching in 2 days.')
            ->action('View Activity', route('activity_dips', $this->activity->id))
            ->line('Please take the necessary actions.');
    }


    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'activity' => $this->activity,
            'message' => 'The deadline for the activity "' . $this->activity->name . '" is approaching in 2 days.',
        ]);
    }

    public function broadcastAs()
    {
        return 'activity-deadline';
    }

    public function toArray($notifiable)
    {
        return [
            'activity_id' => $this->activity->id,
            'message' => 'The deadline for the activity "' . $this->activity->name . '" is approaching in 2 days.',
        ];
    }

}

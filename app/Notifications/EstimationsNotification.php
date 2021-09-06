<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EstimationsNotification extends Notification implements ShouldBroadcast
{
    use Queueable;
    private array $estimationData;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(array $estimationData)
    {
        $this->estimationData = $estimationData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Greetings '.$notifiable->name.',')
            ->line($this->estimationData['body'])
            ->action($this->estimationData['estimationText'], 'http://estimate.local.com/project/'.$this->estimationData['estimationUrl'])
            ->line($this->estimationData['thanks']);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'estimation' => $this->estimationData
        ];
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'estimation' => $this->estimationData
        ]);
    }
}

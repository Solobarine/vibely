<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FriendRequestAccepted extends Notification implements ShouldQueue
{
    use Queueable;

    protected $content;
    protected $username;

    /**
     * Create a new notification instance.
     */
    public function __construct(String $content, String $username)
    {
        $this->content = $content;
        $this->username = $username;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    public function toDatabase(object $notifiable)
    {
        return [
            'subject' => 'Friend Request Accepted',
            'content' => $this->content,
            'links' => [
                [
                    'name' => 'View Profile',
                    'link' => route('user.profile', ['username' => $this->username])
                ]
            ]
        ];
    }
}

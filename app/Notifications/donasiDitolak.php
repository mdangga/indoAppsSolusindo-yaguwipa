<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class donasiDitolak extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public $donasi)
    {
        //
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
            'title' => 'Donasi Ditolak',
            'message' => 'Pengajuan donasi Anda telah ditolak. klik untuk melihat detail.',
            'type' => 'rejected',
            'time' => now()->toDateTimeString(),
            'url' => route('user-donasi.detail', $this->donasi->id_donasi),
        ];
    }
}

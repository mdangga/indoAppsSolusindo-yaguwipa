<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class KerjaSamaDitolak extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public $kerjaSama)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //         ->line('The introduction to the notification.')
    //         ->action('Notification Action', url('/'))
    //         ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Kerja Sama Ditolak',
            'message' => 'Pengajuan kerja sama Anda telah ditolak.',
            'type' => 'rejected',
            'time' => now()->toDateTimeString(),
            'kerja_sama_id' => $this->kerjaSama->id_kerja_sama,
        ];
    }
}

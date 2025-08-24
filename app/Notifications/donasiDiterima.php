<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class donasiDiterima extends Notification
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
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //         ->subject('Status Donasi Anda: Diterima')
    //         ->greeting('Halo ' . $notifiable->nama . '!')
    //         ->line('Kami ingin memberitahukan bahwa pengajuan donasi Anda dengan ID #' . $this->donasi->id_donasi . ' berjenis ' . $this->donasi->JenisDonasi->nama . ' telah diterima.')
    //         ->action('Lihat Detail Donasi', route('user-donasi.detail', $this->donasi->id_donasi))
    //         ->line('Terima kasih atas niat baik Anda. Kami menghargai kontribusi Anda dalam mendukung misi kami.');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Donasi Diterima',
            'message' => 'Pengajuan donasi Anda telah diterima. klik untuk melihat detail.',
            'type' => 'success',
            'time' => now()->toDateTimeString(),
            'url' => route('user-donasi.detail', $this->donasi->id_donasi),
        ];
    }
}

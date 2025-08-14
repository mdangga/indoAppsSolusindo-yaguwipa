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
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Status Donasi Anda: Ditolak')
            ->greeting('Halo ' . $notifiable->nama . '!')
            ->line('Kami ingin memberitahukan bahwa pengajuan donasi Anda dengan ID #' . $this->donasi->id_donasi . ' berjenis ' . $this->donasi->JenisDonasi->nama . ' telah ditolak.')
            ->line('Penolakan ini mungkin disebabkan oleh ketidaksesuaian data, dokumen tidak lengkap, atau alasan lain yang telah kami sampaikan di sistem.')
            ->action('Lihat Detail Donasi', route('user-donasi.detail', $this->donasi->id_donasi))
            ->line('Terima kasih atas niat baik Anda. Anda dapat mengajukan donasi kembali setelah memperbaiki data yang diperlukan.');
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

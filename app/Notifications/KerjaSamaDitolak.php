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
    //         ->subject('Status Kerja Sama Anda: Ditolak')
    //         ->greeting('Halo ' . $notifiable->nama . '!')
    //         ->line('Kami ingin memberitahukan bahwa pengajuan kerja sama Anda dengan ID #' . $this->kerjaSama->id_kerja_sama . ' berjenis ' . $this->kerjaSama->KategoriKerjaSama->nama . ' Untuk program ' . $this->kerjaSama->Program->nama . ' telah ditolak.')
    //         ->line('Penolakan ini mungkin disebabkan oleh ketidaksesuaian data, dokumen tidak lengkap, atau alasan lain yang telah kami sampaikan di sistem.')
    //         ->action('Lihat Detail Kerja Sama', route('kerja-sama.detail', $this->kerjaSama->id_kerja_sama))
    //         ->line('Terima kasih atas niat baik Anda. Anda dapat mengajukan kerja sama kembali setelah memperbaiki data yang diperlukan.');
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
            'message' => 'Pengajuan kerja sama Anda telah ditolak. klik untuk melihat detail.',
            'type' => 'rejected',
            'time' => now()->toDateTimeString(),
            'url' => route('kerja-sama.detail', $this->kerjaSama->id_kerja_sama),
        ];
    }
}

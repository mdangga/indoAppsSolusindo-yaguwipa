<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class KerjaSamaDisetujui extends Notification
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
        return ['mail' , 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Status kerja Sama Anda: Diterima')
            ->greeting('Halo ' . $notifiable->nama . '!')
            ->line('Kami ingin memberitahukan bahwa pengajuan kerja sama Anda dengan ID #' . $this->kerjaSama->id_kerja_sama . ' berjenis ' . $this->kerjaSama->KategoriKerjaSama->nama . ' Untuk program ' . $this->kerjaSama->Program->nama . ' telah diterima.')
            ->action('Lihat Detail Kerja Sama', route('kerja-sama.detail', $this->kerjaSama->id_kerja_sama))
            ->line('Terima kasih atas niat baik Anda. Kami menghargai kontribusi Anda dalam mendukung misi kami.');
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'Kerja Sama Disetujui',
            'message' => 'Pengajuan kerja sama Anda telah disetujui. klik untuk melihat detail.',
            'type' => 'success',
            'time' => now()->toDateTimeString(),
            'url' => route('kerja-sama.detail', $this->kerjaSama->id_kerja_sama),
        ];
    }
}

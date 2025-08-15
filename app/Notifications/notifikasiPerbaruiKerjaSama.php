<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class notifikasiPerbaruiKerjaSama extends Notification
{
    use Queueable;

    protected $pengajuan;
    /**
     * Create a new notification instance.
     */
    public function __construct($pengajuan)
    {
        $this->pengajuan = $pengajuan;
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
            'title' => 'Pengajuan Kerja Sama Diperbarui',
            'message' => 'Pengajuan dari ' . $this->pengajuan['nama'] . ' dengan keterangan: "' . $this->pengajuan['keterangan'] . '" telah diperbarui. Silakan periksa detailnya.',
            'type' => 'warning',
            'time' => now()->toDateTimeString(),
            'url' => route('kerjaSama.detail', $this->pengajuan['id']),
        ];
    }
}

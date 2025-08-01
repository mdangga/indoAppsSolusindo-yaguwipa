<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifikasiPengajuanKerjaSama extends Notification
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
    public function via($notifiable)
    {
        return ['database'];
    }

    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //         ->subject('Akun Anda Telah Dinonaktifkan')
    //         ->line('Akun Anda telah dinonaktifkan oleh administrator.')
    //         ->line('Anda tidak dapat mengakses sistem sampai akun diaktifkan kembali.')
    //         ->action('Hubungi Admin', url('/contact'));
    // }

    public function toArray($notifiable)
    {
        return [
            'title' => 'Pengajuan Kerja Sama Baru',
            'message' => 'Pengajuan dari ' . $this->pengajuan['nama'] . ' dengan keterangan: "' . $this->pengajuan['keterangan'] . '" telah diajukan.',
            'type' => 'warning',
            'time' => now()->toDateTimeString(),
            'url' => route('kerjaSama.detail', $this->pengajuan['id']),
        ];
    }
}

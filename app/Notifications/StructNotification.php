<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StructNotification extends Notification
{
    use Queueable;
    protected $donasi;

    /**
     * Create a new notification instance.
     */
    public function __construct($donasi)
    {
        $this->donasi = $donasi;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Struk Donasi #donasi-' . $this->donasi->id_donasi)
            ->greeting('Terima Kasih, ' . $this->donasi->nama)
            ->line('Donasi Anda sebesar Rp ' . number_format($this->donasi->DonasiDana->nominal, 0, ',', '.') . ' telah berhasil.')
            ->line('Campaign: ' . $this->donasi->Campaign->nama)
            ->line('Metode Pembayaran: ' . $this->donasi->DonasiDana->payment_method)
            ->line('Nomor Transaksi: ' . $this->donasi->DonasiDana->payment_id)
            ->action('Lihat Struk', route('guest-donasi.detail', $this->donasi->DonasiDana->payment_id))
            ->line('Donasi Anda sangat berarti, terima kasih!');
    }
}

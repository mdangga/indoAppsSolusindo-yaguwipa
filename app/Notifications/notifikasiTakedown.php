<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class notifikasiTakedown extends Notification
{
    use Queueable;

    protected $data;
    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
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
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Rekomendasi Takedown',
            'message' => 'Review dari ' . $this->data['nama'] . ' mengandung kata tidak pantas: "' . implode('", "', $this->data['kata']) . '"',
            'type' => 'warning',
            'time' => now()->toDateTimeString(),
            'url' => route('admin.review')
                . '?search=' . urlencode($this->kata[0] ?? '')
                . '&cek_kata=1',
        ];
    }
}

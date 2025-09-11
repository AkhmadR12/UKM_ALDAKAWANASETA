<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MemberExpiredNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $member;
    /**
     * Create a new notification instance.
     */
    public function __construct($member)
    {
        $this->member = $member;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    // public function via(object $notifiable): array
    // {
    //     return ['mail'];
    // }
    public function via($notifiable)
    {
        return ['mail'];
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
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Pemberitahuan Masa Keanggotaan Akan Berakhir')
            ->greeting('Halo, ' . $this->member->name)
            ->line('Masa keanggotaan Anda akan berakhir pada: ' . $this->member->tanggal_berakhir->format('d-m-Y'))
            ->line('Segera perpanjang keanggotaan Anda agar tetap aktif.')
            ->action('Perpanjang Sekarang', url('/perpanjang/' . $this->member->id_member))
            ->line('Terima kasih telah menjadi bagian dari Fotografer Indonesia.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

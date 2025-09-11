<?php

namespace App\Notifications;

use App\Models\MembershipPayment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MembershipActivated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $payment;

    public function __construct(MembershipPayment $payment)
    {
        $this->payment = $payment;
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
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your Membership Has Been Activated')
            ->line('Thank you for completing your payment.')
            ->line('Your membership is now active.')
            ->action('Go to Dashboard', url('/dashboard'))
            ->line('Thank you for joining us!');
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

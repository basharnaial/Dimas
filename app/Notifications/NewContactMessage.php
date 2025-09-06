<?php

namespace App\Notifications;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewContactMessage extends Notification implements ShouldQueue
{
    use Queueable;

    protected $contactMessage;

    /**
     * Create a new notification instance.
     */
    public function __construct(ContactMessage $contactMessage)
    {
        $this->contactMessage = $contactMessage;
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
        $message = $this->contactMessage;
        
        return (new MailMessage)
            ->subject('رسالة جديدة من موقع ديماس - New Contact Message from Dimas')
            ->greeting('رسالة جديدة من الموقع / New Website Message')
            ->line("**الاسم / Name:** {$message->name}")
            ->lineIf($message->email, "**البريد الإلكتروني / Email:** {$message->email}")
            ->lineIf($message->phone, "**الهاتف / Phone:** {$message->phone}")
            ->line("**الرسالة / Message:**")
            ->line($message->message)
            ->line('---')
            ->line("**تاريخ الإرسال / Sent at:** " . $message->created_at->format('Y-m-d H:i:s'))
            ->action('عرض في لوحة التحكم / View in Admin Panel', url('/admin/contacts/' . $message->id))
            ->line('شكراً لكم / Thank you!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'contact_message_id' => $this->contactMessage->id,
            'name' => $this->contactMessage->name,
            'email' => $this->contactMessage->email,
            'phone' => $this->contactMessage->phone,
        ];
    }
}

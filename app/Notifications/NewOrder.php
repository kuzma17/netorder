<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewOrder extends Notification implements ShouldQueue
{
    use Queueable;

    private $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->subject('Новый заказ № '.$this->order->id)
        ->greeting('Здравствуйте!')
        ->line('Поступил новый заказ № '.$this->order->id.'.')
        ->line('Детали заказа:')
        ->line('Тип услуги: '.$this->order->typeWork->name.'.')
        ->line('Компания: '.$this->order->firm->name.'.')
        ->line('Офис: '.$this->order->client->name.'.')
        ->line('Сроки выполнения: '.$this->order->date_end.'.')
        ->action('Перейти в NetOrder', url('/'));
       // ->line('Как с нами связаться:');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class lojaNotify extends Notification {

    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $user;


    public function __construct($user) {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable) {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) {
        return (new MailMessage)
                        ->greeting("Olá, " . $this->user->name)
                        ->subject("Confirmação de pagamento")
                        ->line('Estamos muito felizes que a sua compra foi confirmada!')
                        ->line('Em breve enviaremos o produto para você.')
                        ->line('')
                        ->line('Para maiores detalhes do pedido, acesse o menu "Meus Pedidos" no site.')
                        ->action('Meus Pedidos', url(route('meuspedidos')))
                        ->line("")
                        ->line('Obrigado por comprar conosco. Aproveite!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable) {
        return [
                //
        ];
    }

}

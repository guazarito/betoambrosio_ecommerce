<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class postedNotify extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    
    public $user;
    public $rastreio;
    
    public function __construct($user, $rastreio)
    {
       $this->user = $user;
       $this->rastreio = $rastreio;
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
                        ->greeting("Olá, " . $this->user->name)
                        ->subject("Objeto postado")
                        ->line('Seu produto foi enviado.')
                        ->line("Código de rastreio:"." <a href="."'http://loja.betoambrosio.com.br/adm/rastreio/".$this->rastreio."'>".$this->rastreio."</a>")
                        ->line('')
                        ->line('Para maiores detalhes do pedido, acesse o menu "Meus Pedidos" no site.')
                        ->action('Meus Pedidos', url(route('meuspedidos')))
                        ->line("")
                        ->line('Obrigado');
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

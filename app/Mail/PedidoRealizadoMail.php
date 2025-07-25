<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PedidoRealizadoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pedido;
    public $cart;
    public $total;
    public $frete;
    public $subtotal;

    /**
     * Create a new message instance.
     */
    public function __construct($pedido, $cart, $subtotal, $frete, $total)
    {
        $this->pedido = $pedido;
        $this->cart = $cart;
        $this->subtotal = $subtotal;
        $this->frete = $frete;
        $this->total = $total;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pedido Realizado Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.pedido',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        return $this->subject('Confirmação do Pedido')
            ->markdown('emails.pedido')
            ->with([
                'pedido' => $this->pedido,
                'cart' => $this->cart,
                'subtotal' => $this->subtotal,
                'frete' => $this->frete,
                'total' => $this->total,
            ]);
    }
}

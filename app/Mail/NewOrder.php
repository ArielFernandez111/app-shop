<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use App\Cart;

class NewOrder extends Mailable
{   
    use Queueable, SerializesModels;

    public $user;
    public $cart;
    
    public function __construct(User $user, Cart $cart){
        $this->user = $user;
        $this->cart = $cart;
    }

    public function build(){
        return $this->view('emails.new-order')->subject('Un cliente ha realizado un nuevo pedido!');
    }
}

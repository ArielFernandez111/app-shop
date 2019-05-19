<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function update(){
        //accederemos al usuario que ha iniciado sesion que es el cliente (auth()->user()), a partir de ese usuario accederemos a su carrito de compras actual(->cart) y guardaremos en una variable
        $cart = auth()->user()->cart;
        //a partir de ahi modificaremos el valor de su campo status, ahora su estado sera pendiente
        $cart->status = 'Pending';
        //debemos hacer uso del metodo save() para que se ejecute el update correspondiente en la BBDD
        $cart->save();  //UPDATE
        //tras hacer ello vamos a hacer return back y enviaremos una notificacion a traves de una variable de sesion flash
        $notification = 'Tu pedido se ha registrado correctamente. Te contactaremos pronto via mail';
        return back()->with(compact('notification'));
    }
}

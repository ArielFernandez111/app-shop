<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CartDetail;

class CartDetailController extends Controller
{
    public function store(Request $request){
        $cartDetail = new CartDetail();
        //queremos que se almacene el id del usuario que ha iniciado sesion, este cart_id va a darnos el id del carrito de compras activo asociado al usuario siempre
        $cartDetail->cart_id = auth()->user()->cart->id;
        $cartDetail->product_id = $request->product_id;
        $cartDetail->quantity = $request->quantity;
        $cartDetail->save();

        $notification = 'El producto se ha añadido a tu carrito de compras exitosamente';
        return back()->with(compact('notification'));
    }

    //para evitar que otro usuario malintencionado pueda borrar el id de otro usuario, de manera aleatoria entrando al codigo fuente, crearemos una secuencia de pasos
    public function destroy(Request $request){
        $cartDetail = CartDetail::find($request->cart_detail_id);
        //$cartDetail->delete();
        //return back();

        //lo que tenemos que hacer, es si este cart_detail_id realmente pertenece al carrito activo del usuario, es decir, vamos a añadir una condicion que diga lo siguiente 
        //este cartDetail pertenece a un carrito de compras que tiene este id(cart_id) si este id es igual al id del carrito de compras activo del usuario entonces vamos a hacer la eliminiacion de caso contrario no haremos nada 
        if($cartDetail->cart_id == auth()->user()->cart->id){
            $cartDetail->delete();
        }

        $notification = 'El producto se ha eliminado del carrito de compras exitosamente';
        return back()->with(compact('notification'));
        //esto exige que el detalle que se quiere eliminar pertenesca a un carrito de compras que sea igual al id del carrito de compras activo del usuario que esta haciendo la peticion, es decir, del usuario que ha iniciado sesion, de esta manera evitamos que un usuario pueda eliminar detalles de otros carritos de compra con los que no tiene relacion alguna

    }
}

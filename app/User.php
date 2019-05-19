<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Cart;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // relacion entre tabla User y Cart
    public function carts(){
        // 1 usuario puede tener muchos carritos
        return $this->hasMany(Cart::class);
    }

    //Acceso cart_id
    public function getCartAttribute(){
        //nos interesa un carrito cuyo estatus se active(esto significa que es el carrito de compra activo del usuario). Solicitaremos la primera coincidencia
        $cart = $this->carts()->where('status', 'Active')->first();
        //si esto nos devuelve una coincidencia
        if($cart){
            //return $cart->id;
            return $cart;
        }
        //else          si no hubiera ninguna coincidencia crearemos un nuevo carrito activo para el usuario dado que no tiene uno
        $cart = new Cart();
        // su estatus activo
        $cart->status = 'Active';
        // su user_id sera el id de este usuario
        $cart->user_id = $this->id;
        $cart->save();
        //devolvemos el id del carrito de compras recien creado
        //return $cart->id;
        return $cart;
    }
}

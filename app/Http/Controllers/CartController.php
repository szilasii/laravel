<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {
        $valami = Products::query();    


        $data = Cart::join('cart_items', 'carts.id', '=', 'cart_items.id')
              		->join('User', 'User.id', '=', 'carts.userID')
                    ->join('Products', 'Products.id', '=', 'cart_items.productID')
              		->get();

        return  response()->json($valami);
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartItem;

class CartController extends Controller
{
    /**
     * View
     */
    public function view(){

    }

    /**
     * store
     */
    public function store(Request $request, Product $product){
       $quantity = $request->post('quantity', 1);
       $user = $request->user();

       if($user){

            $cartItem = CartItem::where([
                'user_id' => $user->id,
                'product_id' => $product->id
            ])->first();
            
            if ($cartItem) {
                $cartItem->increment('quantity');
            } else {
                CartItem::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'quantity' => 1,
                ]);
            }

       }else{
            
       }

    }

    /**
     * update
     */

    public function update(Request $request, $id){
       
    }

     /**
      * Delete
      */
    
    public function delete(){
       
    }
}

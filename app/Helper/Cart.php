<?php

namespace App\Helper;
use App\Models\CartItem;
use Illuminate\Support\Facades\Cookie;

class Cart{

    /**
     * Get Count
     */
    public static function getCount(){
        if($user = auth()->user()){
            return CartItem::whereUserId($user->id)->sum('quantity');
        }
    }
   
    /**
     * getCartItem
     */
    public static function getCartItems(){
        if($user = auth()->user()){
            return CartItem::whereUserId($user->id)->get()->map(fn (CartItem $item) =>[
                'product_id' => $item->product_id,
                'quantity' => $item->quantity
            ]);
        }
    }

    /**
     * Cookie Cart Item
     */
    public static function getCookieCartItems(){
        return json_decode(request()->cookie('cart_items', '[]'), true);
    }

    /**
     * Set Cookie Cart Items
     */
    public static function setCookieCartItems(){
        Cookie::queue('cart_items', fn(int $carry, array $item) => $carry + $item['quantity'], 0);
    }

    /**
     * Save Cookie
     */
     public static function saveCookie(){
        $user = auth()->user();
        $userCartItems = CartItem::where([
            'user_id' => $user->id
        ])->get()->keyBy('product_id');
        $saveCartItems = [];
        foreach(self::getCookieCartItems() as $cartItem)
        {
            if(isset($userCartItems[$cartItem['product_id']])){
                $userCartItems[$cartItem['product_id']]->update(['quantity' => $cartItem['quantity']]);
                continue;
            }

            $saveCartItems[] = [
                'user_id' => $user->id,
                'product_id' => $cartItem['product_id'],
                'quantity' => $cartItem['quantity']
            ];
        }

        if(!empty($saveCartItems)){
            CartItem::insert($saveCartItems);
        }
     }


     /**
      * Move Cart Item Into DB
      */
    public static function moveCartItemsIntoDb(){
            $request = request();
            $cartItems = self::getCookieCartItems();
            $saveCartItems = [];

            foreach($cartItems as $cartItem){
                // check if the record already exits in the database
                $existingCartItem = CartItem::where([
                    'user_id' => $user->id,
                    'product_id' => $cartItem['product_id'],
                ])->first();

                if(!$existingCartItem){
                    $newCartItems[] = [
                        'user_id' => $user->id,
                        'product_id' => $cartItem['product_id'],
                        'quantity' => $cartItem['quantity']
                    ];
                }
            }

            if(!empty($newCartItems)){
                // Insert the new cart items into the database
                CartItem::insert($newCartItems);
            }
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Services\CartService;
use Illuminate\Http\Request;
use Modules\Ynotz\EasyAdmin\Traits\HasMVConnector;
use Modules\Ynotz\SmartPages\Http\Controllers\SmartController;
use App\Models\Cart;
use App\Models\Wishlist;
use App\Models\Category;
use App\Models\Productvariant;
use Stripe\Stripe;

class CartController extends SmartController
{
    use HasMVConnector;

    public function __construct(Request $request, CartService $service)
    {
        parent::__construct($request);
        $this->connectorService = $service;
        // $this->itemName = null;
        // $this->unauthorisedView = 'easyadmin::admin.unauthorised';
        // $this->errorView = 'easyadmin::admin.error';
        // $this->indexView = 'easyadmin::admin.indexpanel';
        // $this->showView = 'easyadmin::admin.show';
        // $this->createView = 'easyadmin::admin.form';
        // $this->editView = 'easyadmin::admin.form';
        // $this->itemsCount = 10;
        // $this->resultsName = 'results';
    }
    public function addToCart(Request $request){
        if(auth()->user()){
            $request->validate([
                'product_variant_id'=>'required|exists:products,id',
            ]);
            $exsistingItem=Cart::where('user_id',auth()->user()->id)
                            ->where('product_variant_id',$request->product_variant_id)
                            ->first();
            if($exsistingItem && $exsistingItem->count > 0){
                return redirect()->back()->with('error','Item already in the  cart');
    
            }
            
            
            $productVariant = Productvariant::find($request->product_variant_id);
            $totalQuantity=$productVariant->quantity;
            if($totalQuantity){
                $cart=new Cart;
                $cart->user_id=auth()->user()->id;
                $cart->product_variant_id=$productVariant->id;
                $cart->count=1;
                $cart->price = $productVariant->price;
                $totalQuantity-=1;
                $cart->save();
                Wishlist::where('product_variant_id',$cart->product_id)->delete();
    
                return redirect()->back()->with('success',"{$cart->productvariant->name } added to the cart");
            }
            else{
                return redirect()->back()->with('error','Out of Stock');
            }
        }
       
        

    }
    public function cartIndex(){
        if(auth()->user()){
            $categories=Category::all();
        $addresses= Address::where('user_id',auth()->user()->id)->with('tag')->get();
        $cartItems=Cart::where('user_id',auth()->user()->id)->paginate(3);
        return view('display.cart',['cartItems'=>$cartItems,'categories'=>$categories,'addresses'=>$addresses]);
        }
        
    }

    public function plusCart(Productvariant $variant){
        
        $totalQuantity = $variant->quantity;

        if ($totalQuantity > 0){
            // Retrieve the cart item and update the count
            $cartItem = Cart::where('product_variant_id', $variant->id)->first();
   
            if ($cartItem) {
                $cartItem->count += 1;
                $cartItem->price =$cartItem->price * $cartItem->count;
                $totalQuantity-=1;
                $cartItem->save();
   
                return redirect()->back()->with('success', "Cart has {$cartItem->count} of {$cartItem->productvariant->name }");
            }
        } 
        else {
            return redirect()->back()->with('error', 'Out of Stock');
        }
    }
    public function minusCart(Productvariant $variant){
        $totalQuantity = $variant->quantity;

        
            $cartItem = Cart::where('product_variant_id', $variant->id)->first();
   
            if ($cartItem) {
                $cartItem->count -= 1;
                $cartItem->price =$cartItem->price * $cartItem->count;
                $totalQuantity+=1;
                if($cartItem->count == 0){
                    $cartItem->delete();
                }
                else{
                    $cartItem->save();
                }
                
                
   
                return redirect()->back()->with('success',  "item count modified");
            }
        
    }
    public function deleteCart(Productvariant $variant){
        $totalQuantity = $variant->quantity;

        
            $cartItem = Cart::where('product_variant_id', $variant->id)->first();
            $totalQuantity+=$cartItem->count;
            $cartItem->delete();
            return redirect()->back()->with('success', 'Item deleted from  cart');
       
    }

   

}

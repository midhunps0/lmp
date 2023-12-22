<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\OrderService;
use Illuminate\Http\Request;
use App\Models\Cart;
use Modules\Ynotz\EasyAdmin\Traits\HasMVConnector;
use Modules\Ynotz\SmartPages\Http\Controllers\SmartController;

class OrderController extends SmartController
{
    use HasMVConnector;

    public function __construct(Request $request, OrderService $service)
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
    public function orderIndex(){
        $orders=Order::all();
        $categories=Category::all();
        return view('display.order',compact('orders','categories'));
    }
    public function checkout(Request $request){
        $request->validate([
            'total_price'=>'required|int'
        ]);
        $order=new Order;
       
        $cartItems=Cart::where('user_id',auth()->user()->id)->get();
        $order->user_id=auth()->user()->id;
        $order->total_price=$request->total_price;
        $order->status='Order Confirmed';
        $order->save();
        foreach($cartItems as $item){
        
            $orderItem=new OrderItem;
            $orderItem->order_id=$order->id;
            $orderItem->product_id=$item->product->id;
            $orderItem->count=$item->product->count;
            $orderItem->price=$item->product->price;
            $orderItem->save();
        }
        $cartItems->delete();
        return redirect()->back()->with('success','Order placed successfully');

       
       
        
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\orderdetails;
use App\Models\product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    function cart()
    {
        $user_id = auth()->user()->id;
        $cartProducts = Cart::with('product')->where('user_id',$user_id)->get();

        return view('products.cart',['cartProducts'=> $cartProducts]);
    }


        function order()
    {
        $user_id = auth()->user()->id;
        $cartProducts = Cart::with('product')->where('user_id',$user_id)->get();

        return view('products.order',['cartProducts'=> $cartProducts]);
    }

function previousorder()
{
    $user_id = auth()->user()->id;

    $result = Order::with('orderdetails')->get();
      

    return view('products.previousorder', ['orders' => $result]);
}


        function storeOrder(Request $request)
    {
        $newOrder = new Order();
        $newOrder->name = $request -> name;
        $newOrder->email = $request -> email;
        $newOrder->address = $request -> address;
        $newOrder->phone = $request -> phone;
        $newOrder->note = $request -> note;
        $user_id = auth()->user()->id;
        $newOrder->user_id = $user_id;

        $newOrder ->save();

        $cartProducts = Cart::with('product')->where('user_id',$user_id)->get();

        foreach($cartProducts as $item){
            $newOrderDetail = new orderdetails();
            $newOrderDetail -> product_id = $item->product_id;
            $newOrderDetail -> price = $item->product->price;
            $newOrderDetail -> amount = $item->amount;
            $newOrderDetail -> order_id = $newOrder->id;
            $newOrderDetail->save();
        }

        Cart::where('user_id',$user_id)->delete();

        return redirect('/');
    }



}

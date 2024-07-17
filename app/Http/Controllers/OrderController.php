<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function getOrders(){
        $orders = Order::all();

        return $orders;
    }

    public function createOrder(Request $request){
        $order = new Order();

        $order->order_number = $request->get('order_number');
        $order->status = $request->get('status');

        $order->save();

        return ["message"=>"create success","data"=>$order];
    }

    public function getOrder($orderId){
        $order = Order::find($orderId);

        if($order){
            return $order;
        }else{
            return response(["message"=>"Order not Found"],400);
        }
    }

    public function deleteOrder($orderId){
        $orderFound = Order::find($orderId);

        if($orderFound){
            $orderFound->delete();

            return ["message"=> "delete order success", "data"=>$orderFound];
        }else{
            return response(["message"=>"Order not Found"],400);
        }
    }

    public function updateOrder($orderId , Request $request){
        $order = Order::find($orderId);

        if($order){
            $order->order_number = $request->get('order_number');
            $order->status = $request->get('status');

            $order->save();

            return $order;
        }
    }
}

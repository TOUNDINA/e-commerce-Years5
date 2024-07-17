<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order_products;

class Order_productsController extends Controller
{
    public function getOrderProducts(){
        $orderProduct = Order_products::all();

        return $orderProduct;
    }

    public function createOrderProduct(Request $request){
        $orderProduct = new Order_products();

        $orderProduct->product_id = $request->get('product_id');
        $orderProduct->order_id = $request->get('order_id');

        $orderProduct->save();

        return ["message"=>"create success", "data"=>$orderProduct];
    }

    public function getOrderProduct($orderProductId){
        $orderProduct = Order_products::find($orderProductId);

        if($orderProduct){
            return $orderProduct;
        }else{
            return response(["message"=>"Order products not Found"],400);
        }


    }

    public function deleteOrderProduct($orderProductId){
        $orderProduct = Order_products::find($orderProductId);

        if($orderProduct){
            $orderProduct->delete();

            return ["message"=>"delete success","data"=>$orderProduct];
        }else{
            return response(["message"=>"Order product not Found"], 400);
        }
    }
    public function updateOrderProduct(Request $request,$order_productsId){
        $orderProduct = Order_products::find($order_productsId);

        if($orderProduct){
            $orderProduct->product_id = $request->get('product_id');
            $orderProduct->order_id == $request->get('order_id');

            $orderProduct->save();

            return $orderProduct;
        }
    }
    
}

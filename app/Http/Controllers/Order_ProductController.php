<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Order_Product;

class Order_ProductController extends Controller
{
    public function getOrder_Products(){
        $order_products = Order_Product::all();
        return $order_products;

    }
    public function createOrder_Product(Request $request){
        $order_product = new Order_Product();
        $order_product->product_id = $request->get('product_id');
        $order_product->order_id = $request->get('order_id');
        $order_product->save();
        return ["message"=>"Create Success"];
    }
    public function getOrder_Product($order_prductId){
        $order_product = Order_Product::find($order_productId);
        if($order_product){
            return $order_product;
        }
        else{
            return response(["message"=>"Order_product not found!"],400);
        }

    }
    public function updateOrder_Product(Request $request, $order_productId)
{
    $order_product = Order_Product::find($order_productId);
    if ($order_product) {
        $order_product->product_id = $request->get('product_id');
        $order_product->order_id = $request->get('order_id');
        $order_product->save();

        return ["message" => "Update success", "data" => $order_product];
    } else {
        return response(["message" => "Order_Product not found!"], 400);
    }
}

    public function deleteOrder_Product($order_productId){
        $order_product = Order_Product::find($order_productId);
        if($order_product){
            $order_product->delete();
            return ["message"=>"delete success"];
        }
        else{
            return response(["message"=>"Order_Product not found!"],400);
        }
    }
}

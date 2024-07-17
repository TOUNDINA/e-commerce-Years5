<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function getSuppliers(){
        $suppliers = Supplier::all();

        return $suppliers;
    }

    public function createSupplier(Request $request){
        $supplier = new Supplier();

        $supplier->name = $request->get('name');
        $supplier->address = $request->get('address');
        $supplier->phone = $request->get('phone');
        $supplier->email = $request->get('email');

        $supplier->save();

        return ["message"=>"success", "data"=>$supplier];
    }

    public function getSupplier($supplierId){
        $supplier = Supplier::find($supplierId);
        
        if($supplier){
            return $supplier;
        }else{
            return response(["message"=>"Supplier not Found"],400);
        }
        
    }

    public function updateSupplier(Request $request , $supplierId){
        $supplier = Supplier::find($supplierId);

        if($supplier){
            $supplier->name = $request->get('name');

            $supplier->save();

            return ["message"=>"Updated" , "data"=>$supplier];
        }else{
            return response(["message"=>"Supplier not Found"],400);
        }
        
    }

    public function deleteSupplier($supplierId){
        $supplierFound = Supplier::find($supplierId);

        if($supplierFound){
            $supplierFound->delete();

            return ["message"=>"delete supplier success","data"=>$supplierFound];
        }else{
            return response(["message"=>"Supplier not Found"],400);
        }
    }
}


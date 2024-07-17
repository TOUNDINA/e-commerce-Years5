<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Resources\CategoryResource;

class CategoryController extends Controller
{
    // -- GET / api / categories
    // public function getCategories(){
    //     $categories = Category::all();
    //     // $categories = Category::take(2)->get(); // get mean run query
    //     return $categories;
    //     // code to get from database
    //     // return "get categories";
    // }
    public function getCategories(){
        return   Category::orderBy('id','asc')->paginate(10);
    }

    // -- POST / api / categories == create category
    public function createCategory(Request $request){
        // dd($request);
        $category = new Category(); // create model instand
        $category->name = $request->get('name'); // assign value to model instand
        $category->description = $request->get('description'); // assign value to model instand
        $category->save(); // save data into database
        return [ "message" => "success" , "data"=>$category];// return data that have already save

    }

    // -- GET / api / categories / {categoryId} == get one category
    public function getCategory($categoryId){
        // dd($categoryId);
        $category = Category::find($categoryId);
        if($category){
            return $category;
        }else{
            return response(["message" =>"category not found"],400);
        }
       

    }

    // -- PATCH /api / categories / {categoryId} == update category
    public function updateCategory(Request $request , $categoryId){ // data bos pi postman 
        
        // dd($request->all());
        $category = Category::find($categoryId);

        if($category){
            $category->name = $request->get('name');
            $category->description = $request->get('description');

            $category->save();

           return $category;
        }
    }

    // -- DELETE /api/categories/{categoryId}
    public function deleteCategory($categoryId){//part parameter automatic convert
        $categoryFound = Category::find($categoryId);

        if($categoryFound){
            $categoryFound->delete();

            return ["message" => "delete success"];
        }else{
            return response(["message" =>"category not found"],400); 
        }
        return "delete 1 category";

    }

    // -- GET/api/categories/{categoryId}/products/{productId}
    public function getProductsOfCategory($categoryId){
        //  "list products of 1 category";
        $category = Category::find($categoryId);

        if($category){
            return $category->products; //products() : in here it is a function that have create in category model
        }else{
            return response(["message"=>"Category not Found"],400);
        }

        // dd($category->products());
       
    }

  

    
}

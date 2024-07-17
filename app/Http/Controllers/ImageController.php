<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class ImageController extends Controller
{
    public function getImages()
    {
        $images = Image::all();

        return $images;
    }
  
public function createImage(Request $request){
        // $file = $request->file('image');
        $images=[];
        if($request->hasFile('image')){
            
            foreach ($request->file('image') as $key => $file) {
                # code...
                $image = new Image();
                // $image->images = $request->get('images');
                // if($request->hasFile("image")){
                    Storage::put("/public/".$file->getClientOriginalName().'.jpg',file_get_contents($file) );
                    $path = Storage::disk('local')->url($file->getClientOriginalName().".jpg");
                    $image->images =$path;
                // }
        
                $image->product_id = $request->get('product_id');
        
                $image->save();
                $images[]=$image;
            }
        }

        return ["message"=>"image create success","data"=>$image];
    }

    public function getImage($imageId)
    {
        $image = Image::find($imageId);

        if ($image) {
            return $image;
        } else {
            return response(['message' => 'Image not Found'], 400);
        }
    }
    
    public function updateImage(Request $request)
    {
        $images = $request->file('image');
        $product_id = $request->get('product_id');
        $uploadedImages = [];

        // Check if images are present in the request
        if ($images && is_array($images)) {
            foreach ($images as $file) {
                $image = new Image();
                // Store the image in storage
                Storage::put("/public/" . $file->getClientOriginalName() . '.jpg', file_get_contents($file));
                // Get the path of the stored image
                $path = Storage::disk('local')->url($file->getClientOriginalName() . ".jpg");
                // Set the image path
                $image->images = $path;
                // Set the product id
                $image->product_id = $product_id;
                // Save the image
                $image->save();
                // Add the uploaded image to the array
                $uploadedImages[] = $image;
            }
        }

        // Fetch the product with associated images
        $product = Product::with('images')->find($product_id);

        return ["message" => "Images updated successfully", "data" => $product];
    }

    public function deleteImage($imageId)
    {
        $imageFound = Image::find($imageId);

        if ($imageFound) {
            $imageFound->delete();

            return ["message" => "delete success", "data" => $imageFound];
        } else {
            return response(["message" => "Image not Found"], 400);
        }
    }
}

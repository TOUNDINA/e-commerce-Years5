<?php

// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    // Get all products
    public function index()
    {
        return Product::with('category')->get();
    }

        public function getProducts(){
            // $products = Product::with('images')->get();
            // // ->orderBy('id','desc')->get();// ->paginate()
            // return $products;
            return   Product::orderBy('id','asc')->paginate(20);
        }

        // public function getProducts()
        // {
        //     $products = Product::paginate(10); // Adjust pagination as needed
    
        //     if ($products->isEmpty()) {
        //         return response()->json([
        //             'message' => 'No products found',
        //             'data' => []
        //         ], 404);
        //     }
    
        //     return response()->json([
        //         'message' => 'Products retrieved successfully',
        //         'data' => $products
        //     ], 200);
        // }

   
        public function getFirstImage($productId)
        {
            $product = Product::with('firstImage')->find($productId);
        
            if (!$product) {
                return response()->json(['message' => 'Product not found'], 404);
            }
        
            $firstImage = $product->firstImage;
        
            if (!$firstImage) {
                return response()->json(['message' => 'No images found for this product'], 404);
            }
        
            return response()->json(['message' => 'First image retrieved successfully', 'data' => $firstImage]);
        }
    // public function update_function(Request $request, $id)
    // {
    //     // Find the product by its ID
    //     $product = Product::find($id);

    //     // Check if the product exists
    //     if ($product) {
    //         // Update the product attributes based on the request inputs
    //         $product->name = $request->input('name');
    //         $product->pricing = $request->input('pricing');
    //         $product->discount = $request->input('discount');
    //         $product->color = $request->input('color');
    //         $product->size = $request->input('size');
    //         $product->brand = $request->input('brand');
    //         $product->category_id = $request->input('category_id');
    //         $product->supplier_id = $request->input('supplier_id');

    //         // Save the updated product
    //         $product->save();

    //         // Redirect to the product view with a success message
    //         return redirect('productview')->with('success', 'Data Updated');
    //     } else {
    //         // Handle the case where the product with the given ID is not found
    //         return response()->json(['message' => 'Product not found'], 404);
    //     }
    // }

    // // -- POST / api/products
    // public function createProduct(Request $request){
    //     $product = new Product();
    //     $product->name = $request->get('name');
    //     $product->pricing = $request->get('pricing');
    //     // $product->discount = $request->get('pricing');
    //     // $product->color = $request->get('color');
    //     $product->size = $request->get('size');
    //     $product->brand = $request->get('brand');
    //     $product->category_id = $request->get('category_id');
    //     // $product->supplier_id = $request->get('supplier_id');

    //     $product->save();

    //     return ["message" => "success","data"=>$product];
    // }


    public function createProduct(Request $request)
    {
        // Validate incoming request if needed
        $request->validate([
            'name' => 'required|string',
            'pricing' => 'required|numeric',
            'size' => 'required|string',
            'brand' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation rules for image upload
            'description' => 'required|string',
        ]);
    
        // Check if product name already exists
        $existingProduct = Product::where('name', $request->input('name'))->first();
        if ($existingProduct) {
            return response()->json([
                'error' => 'Product with this name already exists'
            ], 409); // HTTP 409 Conflict status code
        }
    
        // Handle image upload
        if ($request->hasFile('image')) {
            // Get the file name with extension
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            // Get just the file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get just the extension
            $extension = $request->file('image')->getClientOriginalExtension();
            // File name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            // Upload Image to public storage
            $path = $request->file('image')->storeAs('public', $fileNameToStore);
        } else {
            // Default image path if no image is uploaded
            $fileNameToStore = 'noimage.jpg';
        }
    
        // Create new product
        $product = new Product();
        $product->name = $request->input('name');
        $product->pricing = $request->input('pricing');
        // Other fields
        $product->size = $request->input('size');
        $product->brand = $request->input('brand');
        $product->category_id = $request->input('category_id');
        $product->image = $fileNameToStore; // Assign the image file name to the 'image' field
        $product->description = $request->input('description');
    
        $product->save();
    
        return response()->json([
            'message' => 'Product created successfully',
            'data' => $product
        ], 201);
    }
    
//    public function createProduct(Request $request)
//     {
//         $validated = $request->validate([
//             'name' => 'required|string|max:255',
//             'pricing' => 'required|numeric',
//             // 'discount' => 'nullable|numeric',
//             // 'color' => 'required|string|max:255',
//             'size' => 'required|string|max:255',
//             'brand' => 'required|string|max:255',
//             'category_id' => 'required|exists:categories,id',
//             // 'supplier_id' => 'required|exists:suppliers,id',
//         ]);

//         $product = new Product();
//         $product->name = $validated['name'];
//         $product->pricing = $validated['pricing'];
//         // $product->discount = $validated['discount'];
//         // $product->color = $validated['color'];
//         $product->size = $validated['size'];
//         $product->brand = $validated['brand'];
//         $product->category_id = $validated['category_id'];
//         // $product->supplier_id = $validated['supplier_id'];

//         $product->save();

//         return response()->json(['message' => 'success', 'data' => $product]);
//     }    //     $product->color = $request->get('color');
//     //     $product->size = $request->get('size');
    //     $product->brand = $request->get('brand');
    //     $product->category_id = $request->get('category_id');
    //     $product->supplier_id = $request->get('supplier_id');


    //     $product->save();

    //     return ["message" =>"success" , "data" => $product ];
    //     // return redirect('product')->with('success','Data saved');
    // }


 



    // -- PATCH / api/products/{productId}
    // public function updateProduct(Request $request, $productId)
    // {

    //     $productFound = Product::find($productId);

    //     if ($productFound) {
    //         $productFound->name = $request->get('name');
    //         $productFound->pricing = $request->get('pricing');
    //         $productFound->size = $request->get('size');
    //         $productFound->brand = $request->get('brand');
    //         $productFound->category_id = $request->get('category_id');
        

    //          // Handle image upload if new image is uploaded
    //     if ($request->hasFile('image')) {
    //         // Get the file name with extension
    //         $fileNameWithExt = $request->file('image')->getClientOriginalName();
    //         // Get just the file name
    //         $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
    //         // Get just the extension
    //         $extension = $request->file('image')->getClientOriginalExtension();
    //         // File name to store
    //         $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
    //         // Upload Image to public storage
    //         $path = $request->file('image')->storeAs('public', $fileNameToStore);
            
    //         // Delete old image if exists and it's not the default image
    //         if ($product->image != 'noimage.jpg') {
    //             Storage::delete('public/' . $product->image);
    //         }

    //         // Assign the new image file name to the 'image' field
    //         $productFound->image = $fileNameToStore;
    //     }


    //         $productFound->save();

    //         return ["message" => "updated", "data" => $productFound];
    //     } else {
    //         return response(["message" => "Product not Found", 400]);
    //     }
    // }
    // public function updateProduct(Request $request, $productId)
    // {
    //     try {
    //         // Validate the request data
    //         $validatedData = $request->validate([
    //             'name' => 'required|string|max:255',
    //             'pricing' => 'required|numeric',
    //             'size' => 'required|string|max:255',
    //             'brand' => 'required|string|max:255',
    //             'category_id' => 'required|integer|exists:categories,id',
    //             'image' => 'nullable|image|max:2048',
    //             'description' => 'required|string|max:255',
    //         ]);
    
    //         $productFound = Product::find($productId);
    
    //         if ($productFound) {
    //             // Update product fields
    //             $productFound->name = $validatedData['name'];
    //             $productFound->pricing = $validatedData['pricing'];
    //             $productFound->size = $validatedData['size'];
    //             $productFound->brand = $validatedData['brand'];
    //             $productFound->description = $validatedData['description'];
    //             $productFound->category_id = $validatedData['category_id'];
    
    //             // Handle image upload if new image is uploaded
    //             if ($request->hasFile('image')) {
    //                 // Get the file name with extension
    //                 $fileNameWithExt = $request->file('image')->getClientOriginalName();
    //                 // Get just the file name
    //                 $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
    //                 // Get just the extension
    //                 $extension = $request->file('image')->getClientOriginalExtension();
    //                 // File name to store
    //                 $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
    //                 // Upload Image to public storage
    //                 $path = $request->file('image')->storeAs('public', $fileNameToStore);
    
    //                 // Delete old image if exists and it's not the default image
    //                 if ($productFound->image != 'noimage.jpg' && Storage::disk('public')->exists($productFound->image)) {
    //                     Storage::disk('public')->delete($productFound->image);
    //                 }
    
    //                 // Assign the new image file name to the 'image' field
    //                 $productFound->image = $fileNameToStore;
    //             }
    
    //             $productFound->save();
    
    //             return response()->json(["message" => "Product updated successfully", "data" => $productFound], 200);
    //         } else {
    //             return response()->json(["message" => "Product not found"], 404);
    //         }
    //     } catch (\Illuminate\Validation\ValidationException $e) {
    //         return response()->json(["message" => "Validation failed", "errors" => $e->errors()], 422);
    //     } catch (\Exception $e) {
    //         return response()->json(["message" => "An error occurred", "error" => $e->getMessage()], 500);
    //     }
    // }
    public function updateProduct(Request $request, $productId)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'name' => 'nullable|string|max:255',
                'pricing' => 'nullable|numeric',
                'size' => 'nullable|string|max:255',
                'brand' => 'nullable|string|max:255',
                'category_id' => 'nullable|integer|exists:categories,id',
                'image' => 'nullable|image|max:2048',
                'description' => 'nullable|string|max:255',
            ]);
    
            $productFound = Product::find($productId);
    
            if ($productFound) {
                // Update product fields if they exist in the request
                if ($request->has('name')) {
                    $productFound->name = $validatedData['name'];
                }
                if ($request->has('pricing')) {
                    $productFound->pricing = $validatedData['pricing'];
                }
                if ($request->has('size')) {
                    $productFound->size = $validatedData['size'];
                }
                if ($request->has('brand')) {
                    $productFound->brand = $validatedData['brand'];
                }
                if ($request->has('description')) {
                    $productFound->description = $validatedData['description'];
                }
                if ($request->has('category_id')) {
                    $productFound->category_id = $validatedData['category_id'];
                }
    
                // Handle image upload if new image is uploaded
                if ($request->hasFile('image')) {
                    // Get the file name with extension
                    $fileNameWithExt = $request->file('image')->getClientOriginalName();
                    // Get just the file name
                    $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                    // Get just the extension
                    $extension = $request->file('image')->getClientOriginalExtension();
                    // File name to store
                    $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                    // Upload Image to public storage
                    $path = $request->file('image')->storeAs('public', $fileNameToStore);
    
                    // Delete old image if exists and it's not the default image
                    if ($productFound->image != 'noimage.jpg' && Storage::disk('public')->exists($productFound->image)) {
                        Storage::disk('public')->delete($productFound->image);
                    }
    
                    // Assign the new image file name to the 'image' field
                    $productFound->image = $fileNameToStore;
                }
    
                $productFound->save();
    
                // Fetch the updated product data
                $updatedProduct = Product::find($productId);
    
                return response()->json(["message" => "Product updated successfully", "data" => $updatedProduct], 200);
            } else {
                return response()->json(["message" => "Product not found"], 404);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(["message" => "Validation failed", "errors" => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(["message" => "An error occurred", "error" => $e->getMessage()], 500);
        }
    }
    

    
    // -- DELETE /api/products/{productId}
    public function deleteProduct($productId)
{
    $productFound = Product::find($productId);

    if ($productFound) {
        // Delete associated image file from storage
        if ($productFound->image && Storage::disk('public')->exists($productFound->image)) {
            Storage::disk('public')->delete($productFound->image);
        }

        // Delete the product record from the database
        $productFound->delete();

        return ["message" => "Delete success"];
    } else {
        return response()->json(["message" => "Product not found"], 404);
    }
}

// public function updateProduct(Request $request, $productId)
// {
//     // Validate incoming request if needed
//     $request->validate([
//         'name' => 'sometimes|required|string',
//         'pricing' => 'sometimes|required|numeric',
//         'size' => 'sometimes|required|string',
//         'brand' => 'sometimes|required|string',
//         'category_id' => 'sometimes|required|exists:categories,id',
//         'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation rules for image upload
//     ]);

//     // Find the product by ID
//     $product = Product::findOrFail($productId);

//     // Handle image upload if new image is uploaded
//     if ($request->hasFile('image')) {
//         // Get the file name with extension
//         $fileNameWithExt = $request->file('image')->getClientOriginalName();
//         // Get just the file name
//         $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
//         // Get just the extension
//         $extension = $request->file('image')->getClientOriginalExtension();
//         // File name to store
//         $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
//         // Upload Image to public storage
//         $path = $request->file('image')->storeAs('public', $fileNameToStore);
        
//         // Delete old image if exists and it's not the default image
//         if ($product->image != 'noimage.jpg') {
//             Storage::delete('public/' . $product->image);
//         }

//         // Assign the new image file name to the 'image' field
//         $product->image = $fileNameToStore;
//     }

//     // Update product fields if they are provided in the request
//     if ($request->has('name')) {
//         $product->name = $request->get('name');
//     }
//     if ($request->has('pricing')) {
//         $product->pricing = $request->get('pricing');
//     }
//     if ($request->has('size')) {
//         $product->size = $request->get('size');
//     }
//     if ($request->has('brand')) {
//         $product->brand = $request->get('brand');
//     }
//     if ($request->has('category_id')) {
//         $product->category_id = $request->get('category_id');
//     }

//     $product->save();

//     return response()->json([
//         'message' => 'Product updated successfully',
//         'data' => $product
//     ], 200);
// }
public function getProduct($productId)
{
    $product = Product::find($productId);

    if (!$product) {
        return response()->json(['error' => 'Product not found'], 404);
    }

    return response()->json([
        'message' => 'Product retrieved successfully',
        'data' => $product
    ], 200);
}

    // public function deleteProduct($productId)
    // {
    //     $productFound = Product::find($productId);

    //     if ($productFound) {
    //         $productFound->delete();

    //         return ["message" => "delete success"];
    //     } else {
    //         return response(["message" => "Product not Found"], 400);
    //     }
    // }
    // -- GET /api/products/{productId}
//   public function getProduct($productId)
// {
//     // Retrieve a single product based on $productId
//     $product = Product::findOrFail($productId); // Assuming Product model exists and has 'id' as primary key

//     // Fetch images associated with the product
//     $images = json_decode($product->images, true); // Adjust based on your actual data structure

//     // You can also adjust the format of the images array if needed
//     // For example, if each product has an 'image' field and an 'additional_images' field:
//     // $images = [
//     //     'image' => $product->image,
//     //     'additional_images' => json_decode($product->additional_images, true),
//     // ];

//     // Add the images array to the product object
//     $product->images = $images;

//     return response()->json($product);
// }

    // public function getProduct($productId)
    // {
    //     $product = Product::find($productId);
    //     if ($product) {
    //         return $product;
    //     } else {
    //         return response(["message" => "product not found"], 400);
    //     }
    // }

    public function getImagesOfProduct()
    {
    }
    public function findProductsOfCategory($productId)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}


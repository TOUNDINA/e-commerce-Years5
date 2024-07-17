<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\Product;
use Carbon\Carbon;

class PromotionController extends Controller
{
    // Display a listing of the promotions
    public function index()
    {
        $promotions = Promotion::all();
        return response()->json($promotions);
    }

    public function store(Request $request)
{


    // Create the promotion
    $promotion = Promotion::create($request->only('name', 'description', 'discount_percentage', 'start_date', 'end_date', 'status'));

    // Attach products with discounted prices if product_ids is provided
    if ($request->has('product_ids') && is_array($request->product_ids)) {
        foreach ($request->product_ids as $productId) {
            $product = Product::find($productId);
            if ($product) {
                $discountPrice = $product->price * (1 - $request->discount_percentage / 100);
                $promotion->products()->attach($product->id, ['discount_price' => $discountPrice]);
            }
        }
    }

    // Eager load products to include in the response
    $promotionWithProducts = Promotion::with('products')->findOrFail($promotion->id);

    return response()->json([
        'message' => 'Promotion created successfully',
        'promotion' => $promotionWithProducts,
    ]);
}

    // Display the specified promotion
    public function show($id)
    {
        // Eager load the products relationship
        $promotion = Promotion::with('products')->findOrFail($id);
    
        return response()->json($promotion);
    }
    

  

    // Update the specified promotion in storage
    public function update(Request $request, $id)
    {    
        // Find the promotion to update
        $promotion = Promotion::findOrFail($id);
    
        // Update promotion details
        $promotion->update($request->only('name', 'description', 'discount_percentage', 'start_date', 'end_date', 'status'));
    
        // Clear existing product associations
        $promotion->products()->detach();
    
        // Attach updated products with discounted prices
        foreach ($request->product_ids as $productId) {
            $product = Product::find($productId);
            if ($product) {
                $discountPrice = $product->price * (1 - $request->discount_percentage / 100);
                $promotion->products()->attach($product->id, ['discount_price' => $discountPrice]);
            }
        }
    
        return response()->json(['message' => 'Promotion updated successfully', 'promotion' => $promotion]);
    }
    

    // Remove the specified promotion from storage
    public function destroy($id)
    {
        $promotion = Promotion::findOrFail($id);
        $promotion->delete();

        return response()->json(['message' => 'Promotion deleted successfully']);
    }

    // Display discount history
    public function history()
    {
        $history = DB::table('product_promotion')
            ->join('products', 'product_promotion.product_id', '=', 'products.id')
            ->join('promotions', 'product_promotion.promotion_id', '=', 'promotions.id')
            ->select('products.name as product_name', 'promotions.name as promotion_name', 'promotions.discount_percentage', 'promotions.start_date', 'promotions.end_date')
            ->get();

        return response()->json($history);
    }
}
?>

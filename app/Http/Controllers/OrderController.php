<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    /**
     * SAve a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order(Request $request){
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;
        
        if($quantity > $product->available_stock || empty($request->bearerToken()))
            return response()->json(['message' => "Failed to order this product due to unavailability of the stock"], 400);

        Order::create([
            'product_id' => $request->product_id,
            'quantity' => $quantity
        ]);
        $product->available_stock = ($product->available_stock - $quantity);
        $product->save();

        return response()->json(['message' => "You have successfully ordered this product."], 201);
    }
}

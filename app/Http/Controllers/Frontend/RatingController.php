<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function add(Request $request)
    {
        $stars_rated = $request->input('product_rating');
        $review = $request->input('review');
        $product_id = $request->input('product_id');

        $product_check = Product::where('id', $product_id)->where('status','1')->first();
        if ($product_check) {
            $verified_purchase = Order::where('orders.user_id', Auth::id())
            ->join('order_items', 'orders.id','order_items.order_id')
            ->where('order_items.prod_id', $product_id)
            ->get();

            if ($verified_purchase->count() > 0) {
                $existing_rating = Rating::where('user_id', Auth::id())->where('prod_id', $product_id)->exists();
                if ($existing_rating) {
                    $update_rating = Rating::where('prod_id', $product_id)->where('user_id', Auth::id())->first();
                    $update_rating->stars_rated = $stars_rated;
                    $update_rating->review = $review;
                    $update_rating->update();
                }else {
                    Rating::create([
                        'user_id' => Auth::id(),
                        'prod_id' => $product_id,
                        'stars_rated' => $stars_rated,
                        'review' => $review
                    ]);
                }
            }else{
                return redirect()->back()->with('status', "You cannot rate a product whitout purchase");
            }
            return redirect()->back()->with('status', "Thank you for Rating this product");
        }else {
            return redirect()->back()->with('status', "The link followed was broken");
        }
    }
}

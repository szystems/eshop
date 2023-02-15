<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Config;
use Illuminate\Support\Facades\Auth;
use DB;

class CartController extends Controller
{
    public function addProduct(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        if(Auth::check())
        {
            $prod_check = Product::where('id', $product_id)->first();

            if($prod_check)
            {
                if(Cart::where('prod_id',$product_id)->where('user_id',Auth::id())->exists())
                {
                    return response()->json(['status' => $prod_check->name." Already Added to cart"]);
                }else
                {
                    if ($prod_check->qty >= $product_qty) {

                        $cartItem = new Cart();
                        $cartItem->prod_id = $product_id;
                        $cartItem->user_id = Auth::id();
                        $cartItem->prod_qty = $product_qty;
                        $cartItem->save();

                        if(Wishlist::where('prod_id', $product_id)->where('user_id', Auth::id())->exists())
                        {

                            $wishItem = Wishlist::where('prod_id', $product_id)->where('user_id', Auth::id())->first();
                            $wishItem->delete();

                        }

                        return response()->json(['status' => $prod_check->name." Added to cart"]);
                    }else
                    {
                        return response()->json(['status' => $prod_check->name." Quantity exceeds stock, availability: ".$prod_check->qty]);
                    }


                }

            }

        }else
        {
            return response()->json(['status' => "Login to continue"]);
        }

    }

    public function viewcart()
    {
        // $cartitems = Cart::where('user_id', Auth::id())->get();
        $cartitems = DB::table('carts as c')
        ->join('products as p','c.prod_id','=','p.id')
        ->join('categories as cat','p.cate_id','cat.id')
        ->where('c.user_id',Auth::id())
        ->select('c.id','c.user_id','c.prod_id as ProdID','c.prod_qty','p.name as Product','p.slug as ProdSlug','p.small_description','p.description','p.original_price','p.selling_price','p.image','p.qty','p.tax','p.status','p.trending','p.discount','p.cate_id','cat.name as Category','cat.slug as CatSlug')
        ->orderBy('p.name','asc')
        ->get();
        $config = Config::first();
        return view('frontend.cart', compact('cartitems','config'));
    }

    public function deleteproduct(Request $request)
    {
        if(Auth::check())
        {
            $prod_id = $request->input('prod_id');
            if(Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists())
            {

                $cartItem = Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->first();
                $cartItem->delete();
                return response()->json(['status' => "Product Deleted Successfully"]);

            }

        }else
        {
            return response()->json(['status' => "Login to continue"]);
        }
    }

    public function updatecart(Request $request)
    {
        $prod_id = $request->input('prod_id');
        $product_qty = $request->input('prod_qty');

        if(Auth::check())
        {
            if(Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists())
            {
                if ($product_qty > 0) {
                    $cart = Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->first();
                    $cart->prod_qty = $product_qty;
                    $cart->update();
                    return response()->json(['status' => "Quantity updated"]);
                } else {
                    return response()->json(['status' => "Quantity must be greater than '0'"]);
                }


            }
        }
    }

    public function cartcount()
    {
        $cartcount = Cart::where('user_id', Auth::id())->count();
        return response()->json(['count' => $cartcount]);
    }
}

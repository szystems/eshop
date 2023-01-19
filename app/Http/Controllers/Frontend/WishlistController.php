<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use DB;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = DB::table('wishlists as w')
        ->join('products as p','w.prod_id','=','p.id')
        ->join('categories as cat','p.cate_id','cat.id')
        ->where('w.user_id',Auth::id())
        ->select('w.id','w.user_id','w.prod_id as ProdID','p.name as Product','p.slug as ProdSlug','p.small_description','p.description','p.original_price','p.selling_price','p.image','p.qty','p.tax','p.status','p.trending','p.discount','p.cate_id','cat.name as Category','cat.slug as CatSlug')
        ->orderBy('p.name','asc')
        ->get();
        return view('frontend.wishlist', compact('wishlist'));
    }

    public function add(Request $request)
    {
        if(Auth::check())
        {
            $prod_id = $request->input('product_id');
            $prod = Product::where('id', $prod_id)->first();
            if(Product::find($prod_id))
            {
                if(Wishlist::where('prod_id',$prod_id)->where('user_id',Auth::id())->exists())
                {
                    return response()->json(['status' => $prod->name." Already Added to wishlist"]);
                }else
                {
                    $wish = new Wishlist();
                    $wish->prod_id = $prod_id;
                    $wish->user_id = Auth::id();
                    $wish->save();
                    return response()->json(['status' => $prod->name." Added to Wishlist"]);
                }
            }else
            {
                return response()->json(['status' => "Product doesnot exist"]);
            }
        }else
        {
            return response()->json(['status' => "Login to Continue"]);
        }
    }

    public function deleteitem(Request $request)
    {
        if(Auth::check())
        {
            $prod_id = $request->input('prod_id');
            if(Wishlist::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists())
            {

                $wishItem = Wishlist::where('prod_id', $prod_id)->where('user_id', Auth::id())->first();
                $wishItem->delete();
                return response()->json(['status' => "Item Removed from Wishlist"]);

            }

        }else
        {
            return response()->json(['status' => "Login to continue"]);
        }
    }

    public function wishcount()
    {
        $wishcount = Wishlist::where('user_id', Auth::id())->count();
        return response()->json(['count' => $wishcount]);
    }
}

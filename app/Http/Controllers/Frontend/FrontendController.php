<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Rating;
use App\Models\Order;
use App\Models\Config;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {
        $trending = Product::where('trending','1')->where('status','1')->take(15)->orderby('name','asc')->get();
        $popular = Category::where('popular','1')->where('status','1')->take(15)->orderby('name','asc')->get();
        $discount = Product::where('discount','1')->where('status','1')->take(15)->orderby('name','asc')->get();
        $config = Config::first();
        return view('frontend.index', compact('trending','popular','discount','config'));
    }

    public function category()
    {
        $categories = Category::where('status','1')->orderby('name','asc')->get();
        return view('frontend.category', compact('categories'));
    }

    public function viewcategory($slug)
    {
        if(Category::where('slug', $slug)->exists())
        {
            $category = Category::where('slug', $slug)->first();
            $products = Product::where('cate_id', $category->id)->where('status','1')->orderby('name','asc')->get();
            $config = Config::first();
            return view('frontend.products.index', compact('category','products','config'));
        }
        else
        {
            return redirect('/')->with('status',"Slug doesnot exists");
        }

    }

    public function productview($cate_slug, $prod_slug)
    {
        if(Category::where('slug', $cate_slug)->exists())
        {
            if(Product::where('slug', $prod_slug)->exists())
            {
                $product = Product::where('slug', $prod_slug)->first();
                $ratings = Rating::where('prod_id', $product->id)->get();
                $rating_sum = Rating::where('prod_id', $product->id)->sum('stars_rated');
                $verified_purchase = Rating::where('prod_id', $product->id)->where('user_id', Auth::id())->get();
                if ($verified_purchase->count() > 0) {
                    $user_rating_values = Rating::where('prod_id', $product->id)->where('user_id', Auth::id())->first();
                    $user_rating = $user_rating_values->stars_rated;
                    $user_review = $user_rating_values->review;
                }else {
                    $user_rating = 0;
                    $user_review = null;
                }


                if ($ratings->count() > 0) {
                    $rating_value = $rating_sum/$ratings->count();
                } else {
                    $rating_value = 0;
                }

                $config = Config::first();
                return view('frontend.products.show', compact('product','ratings','rating_value','user_rating','user_review','config'));
            }
            else
            {
                return redirect('/')->with('status',"The link was broken");
            }
        }
        else
        {
            return redirect('/')->with('status',"No such category found");
        }
    }

    public function productlistAjax()
    {
        $products = Product::select('name')->where('status','1')->get();
        $data = [];

        foreach ($products as $item) {
            $data[] = $item['name'];
        }

        return $data;
    }

    public function buscarProducto(Request $request)
    {
        $searched_product = $request->product_name;

        if ($searched_product != "") {
            $product = Product::where("name","LIKE","%$searched_product%")->first();
            if ($product) {
                return redirect('category/'.$product->category->slug.'/'.$product->slug);
            }else {
                return redirect()->back()->with('status', "No products matched your search");
            }
        }else {
            return redirect()->back();
        }
    }
}

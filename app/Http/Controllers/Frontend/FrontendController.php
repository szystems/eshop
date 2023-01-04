<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class FrontendController extends Controller
{
    public function index()
    {
        $trending = Product::where('trending','1')->where('status','1')->take(15)->orderby('name','asc')->get();
        $popular = Category::where('popular','1')->where('status','1')->take(15)->orderby('name','asc')->get();
        return view('frontend.index', compact('trending','popular'));
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
            return view('frontend.products.index', compact('category','products'));
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
                return view('frontend.products.show', compact('product'));
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
}

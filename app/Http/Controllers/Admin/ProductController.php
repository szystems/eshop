<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\ProductFormRequest;
use Illuminate\Support\Facades\File;
use DB;

class ProductController extends Controller
{
    public function index()
    {
        $products=DB::table('products as p')
            ->join('categories as c','p.cate_id','=','c.id')
            ->select('p.id','c.id as Idcategory','c.name as Category','p.name','p.description','original_price','selling_price','p.image')
            ->orderBy('p.name','asc')
            ->paginate(20);
        return view('admin.product.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::find($id);
        return view('admin.product.show', compact('product'));
    }

    public function add()
    {
        $categories = Category::all();
        return view('admin.product.add', compact('categories'));
    }

    public function insert(ProductFormRequest $request)
    {
        $product = new Product();
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/product',$filename);
            $product->image = $filename;
        }

        $product->cate_id = $request->input('cate_id');
        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->small_description = $request->input('small_description');
        $product->description = $request->input('description');
        $product->original_price = $request->input('original_price');
        $product->selling_price = $request->input('selling_price');
        $product->qty = $request->input('qty');
        $product->tax = $request->input('tax');
        $product->status = $request->input('status') == TRUE ? '1':'0';
        $product->trending = $request->input('trending') == TRUE ? '1':'0';
        $product->meta_title = $request->input('meta_title');
        $product->meta_keywords = $request->input('meta_keywords');
        $product->meta_description = $request->input('meta_description');
        $product->save();

        return redirect('products')->with('status', "Product Added Successfully");
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('admin.product.edit', \compact('product','categories'));
    }

    public function update(ProductFormRequest $request, $id)
    {
        $product = Product::find($id);
        if($request->hasFile('image'))
        {
            $path = 'assets/uploads/product/'.$product->image;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/product',$filename);
            $product->image = $filename;
        }
        $product->cate_id = $request->input('cate_id');
        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->small_description = $request->input('small_description');
        $product->description = $request->input('description');
        $product->original_price = $request->input('original_price');
        $product->selling_price = $request->input('selling_price');
        $product->qty = $request->input('qty');
        $product->tax = $request->input('tax');
        $product->status = $request->input('status') == TRUE ? '1':'0';
        $product->trending = $request->input('trending') == TRUE ? '1':'0';
        $product->meta_title = $request->input('meta_title');
        $product->meta_keywords = $request->input('meta_keywords');
        $product->meta_description = $request->input('meta_description');
        $product->update();

        return redirect('/products')->with('status',"Product Updated Successfully");
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product->image)
        {
            $path = 'assets/uploads/product/'.$product->image;
            if (File::exists($path))
            {
                File::delete($path);

            }
        }
        $product->delete();
        return redirect('products')->with('status',"Product Deleted Successfully");
    }
}

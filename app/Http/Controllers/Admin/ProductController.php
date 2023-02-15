<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Config;
use App\Models\Category;
use App\Http\Requests\ProductFormRequest;
use Illuminate\Support\Facades\File;
use DB;
use PDF;

class ProductController extends Controller
{
    public function index()
    {
        $products=DB::table('products as p')
            ->join('categories as c','p.cate_id','=','c.id')
            ->select('p.id','c.id as Idcategory','c.name as Category','p.name','p.description','p.original_price','p.selling_price','p.image','p.qty','p.status','p.discount')
            ->orderBy('p.name','asc')
            ->paginate(20);
        $config = Config::first();
        return view('admin.product.index', compact('products','config'));
    }

    public function show($id)
    {
        $product = Product::find($id);
        $config = Config::first();
        return view('admin.product.show', compact('product','config'));
    }

    public function add()
    {
        $categories = Category::all();
        $config = Config::first();
        return view('admin.product.add', compact('categories','config'));
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
        $product->discount = $request->input('discount') == TRUE ? '1':'0';
        $product->meta_title = $request->input('meta_title');
        $product->meta_keywords = $request->input('meta_keywords');
        $product->meta_description = $request->input('meta_description');
        $product->save();

        $config = Config::first();

        return redirect('products')->with('status', "Product Added Successfully");
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();

        $config = Config::first();

        return view('admin.product.edit', \compact('product','categories','config'));
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
        $product->discount = $request->input('discount') == TRUE ? '1':'0';
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

    public function pdf()
    {
        $products=DB::table('products as p')
        ->join('categories as c','p.cate_id','=','c.id')
        ->select('p.id','c.id as Idcategory','c.name as Category','p.name','p.description','p.original_price','p.selling_price','p.image','p.qty','p.status','p.discount')
        ->orderBy('p.name','asc')
        ->get();

        $verpdf = "Browser";
        $nompdf = date('m/d/Y g:ia');
        $path = public_path('assets/uploads/product/');

        $config = Config::first();

        if ( $verpdf == "Download" )
        {
            $pdf = PDF::loadView('admin.product.pdf',['products'=>$products,'path'=>$path,'config'=>$config]);

            return $pdf->download ('Product_list'.$nompdf.'.pdf');
        }
        if ( $verpdf == "Browser" )
        {
            $pdf = PDF::loadView('admin.product.pdf',['products'=>$products,'path'=>$path,'config'=>$config]);

            return $pdf->stream ('Product_list'.$nompdf.'.pdf');
        }
    }
}

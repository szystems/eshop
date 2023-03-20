<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Config;
use App\Models\Category;
use App\Http\Requests\ProductFormRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use DB;
use PDF;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request)
        {
            $queryProduct=$request->input('fproduct');
            $queryCategory=$request->input('fcategory');
            $queryStock=$request->input('fstock');
            $queryStatus=$request->input('fstatus');
            $queryTrending=$request->input('ftrending');
            $queryDiscount=$request->input('fdiscount');
            if ($queryStock == null) {
                $queryStock = ">=";
            }
            $products=DB::table('products as p')
                ->join('categories as c','p.cate_id','=','c.id')
                ->select('p.id','p.code','c.id as Idcategory','c.name as Category','p.name','p.description','p.original_price','p.selling_price','p.image','p.qty','p.status','p.discount','p.trending')
                ->where('c.name','LIKE','%'.$queryCategory.'%')
                ->where('p.name','LIKE','%'.$queryProduct.'%')
                ->where('p.qty',$queryStock,0)
                ->where('p.status','LIKE',$queryStatus)
                ->where('p.trending','LIKE',$queryTrending)
                ->where('p.discount','LIKE',$queryDiscount)
                ->orderBy('p.name','asc')
                ->paginate(25);
            $config = Config::first();
            $filterCategories = Category::all();
            $filterProducts = Product::all();
            return view('admin.product.index', compact('products','config','queryProduct','queryCategory','queryStock','queryStatus','queryTrending','queryDiscount','filterCategories','filterProducts'));
        }
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

        $name_product = $request->input('name');
        $palabras = explode(' ', trim($name_product));
        $num_palabras = str_word_count($name_product);
        $slug = $palabras[0];
        for ($i = 1; $i <= $num_palabras-1; $i++) {
            $slug = $slug."-".ucwords($palabras[$i]);
            error_log("slug: ".$slug);
        }
        if(Product::where('slug',$slug)->exists())
        {
            $slug = $slug.$product->id;
        }

        $product->cate_id = $request->input('cate_id');
        $product->code = $request->input('code');
        $product->name = $request->input('name');
        $product->slug = $slug;
        $product->small_description = $request->input('small_description');
        $product->description = $request->input('description');
        $product->original_price = $request->input('original_price');
        $product->selling_price = $request->input('selling_price');
        $product->qty = $request->input('qty');
        $product->tax = $request->input('tax');
        $product->status = $request->input('status') == TRUE ? '1':'0';
        $product->trending = $request->input('trending') == TRUE ? '1':'0';
        $product->discount = $request->input('discount') == TRUE ? '1':'0';
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

        $name_product = $request->input('name');
        $palabras = explode(' ', trim($name_product));
        $num_palabras = str_word_count($name_product);
        $slug = $palabras[0];
        for ($i = 1; $i <= $num_palabras-1; $i++) {
            $slug = $slug."-".ucwords($palabras[$i]);
            error_log("slug: ".$slug);
        }
        if(Product::where('slug',$slug)->exists())
        {
            $slug = $slug.$product->id;
        }

        $product->cate_id = $request->input('cate_id');
        $product->code = $request->input('code');
        $product->name = $request->input('name');
        $product->slug = $slug;
        $product->small_description = $request->input('small_description');
        $product->description = $request->input('description');
        $product->original_price = $request->input('original_price');
        $product->selling_price = $request->input('selling_price');
        $product->qty = $request->input('qty');
        $product->tax = $request->input('tax');
        $product->status = $request->input('status') == TRUE ? '1':'0';
        $product->trending = $request->input('trending') == TRUE ? '1':'0';
        $product->discount = $request->input('discount') == TRUE ? '1':'0';
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

    public function pdf(Request $request)
    {
        if ($request)
        {
            $queryProduct=$request->input('rproduct');
            $queryCategory=$request->input('rcategory');
            $queryStock=$request->input('rstock');
            $queryStatus=$request->input('rstatus');
            $queryTrending=$request->input('rtrending');
            $queryDiscount=$request->input('rdiscount');
            if ($queryStock == null) {
                $queryStock = ">=";
            }
            $products=DB::table('products as p')
            ->join('categories as c','p.cate_id','=','c.id')
            ->select('p.id','p.code','c.id as Idcategory','c.name as Category','p.name','p.description','p.original_price','p.selling_price','p.image','p.qty','p.status','p.discount','p.trending')
            ->where('c.name','LIKE','%'.$queryCategory.'%')
            ->where('p.name','LIKE','%'.$queryProduct.'%')
            ->where('p.qty',$queryStock,0)
            ->where('p.status','LIKE',$queryStatus)
            ->where('p.trending','LIKE',$queryTrending)
            ->where('p.discount','LIKE',$queryDiscount)
            ->orderBy('c.name','asc')
            ->orderBy('p.name','asc')
            ->get();

            $verpdf = "Browser";
            $nompdf = date('m/d/Y g:ia');
            $path = public_path('assets/uploads/');

            $config = Config::first();

            $currency = $config->currency_simbol;

            if ($config->logo == null)
            {
                $logo = null;
                $imagen = null;
            }
            else
            {
                    $logo = $config->logo;
                    $imagen = public_path('assets/uploads/logos/'.$logo);
            }


            $config = Config::first();

            if ( $verpdf == "Download" )
            {
                $pdf = PDF::loadView('admin.product.pdf',['products'=>$products,'path'=>$path,'config'=>$config,'imagen'=>$imagen,'currency'=>$currency,'queryProduct'=>$queryProduct,'queryCategory'=>$queryCategory,'queryStock'=>$queryStock,'queryStatus'=>$queryStatus,'queryTrending'=>$queryTrending,'queryDiscount'=>$queryDiscount]);

                return $pdf->download ('Product_list'.$nompdf.'.pdf');
            }
            if ( $verpdf == "Browser" )
            {
                $pdf = PDF::loadView('admin.product.pdf',['products'=>$products,'path'=>$path,'config'=>$config,'imagen'=>$imagen,'currency'=>$currency,'queryProduct'=>$queryProduct,'queryCategory'=>$queryCategory,'queryStock'=>$queryStock,'queryStatus'=>$queryStatus,'queryTrending'=>$queryTrending,'queryDiscount'=>$queryDiscount]);

                return $pdf->stream ('Product_list'.$nompdf.'.pdf');
            }
        }
    }

    public function pdfshow(Request $request)
    {
        if ($request)
        {
            $product = Product::find($request->input('rproduct'));

            $verpdf = "Browser";
            $nompdf = date('m/d/Y g:ia');
            $path = public_path('assets/uploads/');

            $config = Config::first();

            $currency = $config->currency_simbol;

            if ($config->logo == null)
            {
                $logo = null;
                $imagen = null;
            }
            else
            {
                    $logo = $config->logo;
                    $imagen = public_path('assets/uploads/logos/'.$logo);
            }


            $config = Config::first();

            if ( $verpdf == "Download" )
            {
                $pdf = PDF::loadView('admin.product.pdfshow',['product'=>$product,'path'=>$path,'config'=>$config,'imagen'=>$imagen,'currency'=>$currency]);

                return $pdf->download ($product->name.$nompdf.'.pdf');
            }
            if ( $verpdf == "Browser" )
            {
                $pdf = PDF::loadView('admin.product.pdfshow',['product'=>$product,'path'=>$path,'config'=>$config,'imagen'=>$imagen,'currency'=>$currency]);

                return $pdf->stream ($product->name.$nompdf.'.pdf');
            }
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Config;
use App\Models\OrderItem;
use App\Models\Product;
use DB;

class FrontendController extends Controller
{
    public function index()
    {
        // last Orders
        $allOrders=DB::table('orders')
        ->get();

        $orders=DB::table('orders')
        ->orderBy('created_at','desc')
        ->limit(10)
        ->get();

        $completeOrders = DB::table('orders')
        ->where('status', '=', '1')
        ->get();

        $pendingOrders = DB::table('orders')
        ->where('status', '=', '0')
        ->get();

        $config = Config::first();

        //popular products

        $popularProducts = OrderItem::select('prod_id', DB::raw('COUNT(*) as `count`'))->groupBy('prod_id')->orderBy('count', 'DESC')->limit(10)->get();

        $allProducts=DB::table('products')
        ->get();

        //Stock alerts

        $stockAlerts=DB::table('products as p')
        ->join('categories as c','p.cate_id','=','c.id')
        ->select('p.id','p.code','c.id as Idcategory','c.name as Category','p.name','p.description','p.original_price','p.selling_price','p.image','p.qty','p.status','p.discount','p.trending')
        ->orderByRaw('CONVERT(p.qty, SIGNED) asc')
        ->paginate(10);

        return view('admin.index', compact('config','orders','completeOrders','pendingOrders','allOrders','popularProducts','allProducts','stockAlerts'));
    }
}

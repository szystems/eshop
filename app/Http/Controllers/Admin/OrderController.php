<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('status','0')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::where('id', $id)->first();
        $orderItems = DB::table('order_items as o')
        ->join('products as p','o.prod_id','=','p.id')
        ->join('categories as cat','p.cate_id','cat.id')
        ->where('o.order_id', $id)
        ->select('o.id','o.prod_id as ProdID','o.qty','o.price','p.name as Product','p.slug as ProdSlug','p.small_description','p.description','p.original_price','p.selling_price','p.image','p.tax','p.status','p.trending','o.discount','p.cate_id','cat.name as Category','cat.slug as CatSlug')
        ->orderBy('p.name','asc')
        ->get();
        return view('admin.orders.show', compact('order','orderItems'));
    }

    public function updateorder(Request $request, $id)
    {
        $order = Order::find($id);
        $order->status = $request->input('order_status');
        $order->update();
        return redirect('orders')->with('status', "Order Updated Successfully");
    }

    public function orderhistory()
    {
        $orders = Order::where('status','1')->get();
        return view('admin.orders.history', compact('orders'));
    }
}

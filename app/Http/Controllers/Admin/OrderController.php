<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Config;
use DB;
use PDF;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if ($request)
        {
            $queryDesde=$request->input('fdesde');
            $queryHasta=$request->input('fhasta');
            $queryStatus=$request->input('fstatus');
            $queryPayment=$request->input('fpayment');



            if ($queryDesde != "" or $queryHasta != "") {


                $queryDesde = date("Y-m-d 00:00:00", strtotime($queryDesde));
                $queryHasta = date("Y-m-d 23:59:59", strtotime($queryHasta));

            }else
            {

                $queryDesde = DB::table('orders')->min('created_at');
                $queryHasta = DB::table('orders')->max('created_at');

                $queryDesde = date("Y-m-d 00:00:00", strtotime($queryDesde));
                $queryHasta = date("Y-m-d 23:59:59", strtotime($queryHasta));
            }

            //convertir fechas de query a timezone por defecto

            $queryDesde = new DateTime($queryDesde, new DateTimeZone(Auth::user()->timezone));
            $queryDesde->setTimezone(new DateTimeZone(date_default_timezone_get()));

            $queryHasta = new DateTime($queryHasta, new DateTimeZone(Auth::user()->timezone));
            $queryHasta->setTimezone(new DateTimeZone(date_default_timezone_get()));

            $queryDesde = $queryDesde->format("Y-m-d H:i:s");
            $queryHasta = $queryHasta->format("Y-m-d H:i:s");

            \error_log($queryDesde);
            \error_log($queryHasta);

            $orders=DB::table('orders')
            ->whereBetween('created_at', [$queryDesde, $queryHasta])
            ->where('status','LIKE','%'.$queryStatus.'%')
            ->where('payment_mode','LIKE','%'.$queryPayment.'%')
            ->orderBy('created_at','desc')
            ->paginate(25);

            $ordersResume=DB::table('orders')
            ->whereBetween('created_at', [$queryDesde, $queryHasta])
            ->where('status','LIKE','%'.$queryStatus.'%')
            ->where('payment_mode','LIKE','%'.$queryPayment.'%')
            ->orderBy('created_at','desc')
            ->get();

            //convertir fechas de query a timezone de usuario

            $queryDesde = new DateTime($queryDesde, new DateTimeZone(date_default_timezone_get()));
            $queryDesde->setTimezone(new DateTimeZone(Auth::user()->timezone));

            $queryHasta = new DateTime($queryHasta, new DateTimeZone(date_default_timezone_get()));
            $queryHasta->setTimezone(new DateTimeZone(Auth::user()->timezone));

            $desde = $queryDesde->format("d-m-Y");
            $hasta = $queryHasta->format("d-m-Y");

            $queryDesde = $queryDesde->format("Y-m-d H:i:s");
            $queryHasta = $queryHasta->format("Y-m-d H:i:s");




            $config = Config::first();
            return view('admin.orders.index', compact('orders','config','queryDesde','queryHasta','queryStatus','queryPayment','desde','hasta','ordersResume'));
        }

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
        $config = Config::first();
        return view('admin.orders.show', compact('order','orderItems','config'));
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
        $config = Config::first();
        return view('admin.orders.history', compact('orders','config'));
    }

    public function pdf(Request $request)
    {
        if ($request)
        {
            $queryDesde=$request->input('rdesde');
            $queryHasta=$request->input('rhasta');
            $queryStatus=$request->input('rstatus');
            $queryPayment=$request->input('rpayment');



            if ($queryDesde != "" or $queryHasta != "") {


                $queryDesde = date("Y-m-d 00:00:00", strtotime($queryDesde));
                $queryHasta = date("Y-m-d 23:59:59", strtotime($queryHasta));

            }else
            {

                $queryDesde = DB::table('orders')->min('created_at');
                $queryHasta = DB::table('orders')->max('created_at');

                $queryDesde = date("Y-m-d 00:00:00", strtotime($queryDesde));
                $queryHasta = date("Y-m-d 23:59:59", strtotime($queryHasta));

            }

            //convertir fechas de query a timezone por defecto

            $queryDesde = new DateTime($queryDesde, new DateTimeZone(Auth::user()->timezone));
            $queryDesde->setTimezone(new DateTimeZone(date_default_timezone_get()));

            $queryHasta = new DateTime($queryHasta, new DateTimeZone(Auth::user()->timezone));
            $queryHasta->setTimezone(new DateTimeZone(date_default_timezone_get()));

            $queryDesde = $queryDesde->format("Y-m-d H:i:s");
            $queryHasta = $queryHasta->format("Y-m-d H:i:s");

            $orders=DB::table('orders')
            ->whereBetween('created_at', [$queryDesde, $queryHasta])
            ->where('status','LIKE','%'.$queryStatus.'%')
            ->where('payment_mode','LIKE','%'.$queryPayment.'%')
            ->orderBy('created_at','desc')
            ->get();

            $ordersResume=DB::table('orders')
            ->whereBetween('created_at', [$queryDesde, $queryHasta])
            ->where('status','LIKE','%'.$queryStatus.'%')
            ->where('payment_mode','LIKE','%'.$queryPayment.'%')
            ->orderBy('created_at','desc')
            ->get();

            //convertir fechas de query a timezone de usuario

            $queryDesde = new DateTime($queryDesde, new DateTimeZone(date_default_timezone_get()));
            $queryDesde->setTimezone(new DateTimeZone(Auth::user()->timezone));

            $queryHasta = new DateTime($queryHasta, new DateTimeZone(date_default_timezone_get()));
            $queryHasta->setTimezone(new DateTimeZone(Auth::user()->timezone));

            $desde = $queryDesde->format("d-m-Y");
            $hasta = $queryHasta->format("d-m-Y");

            $queryDesde = $queryDesde->format("Y-m-d H:i:s");
            $queryHasta = $queryHasta->format("Y-m-d H:i:s");

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
                $pdf = PDF::loadView('admin.orders.pdf',['orders'=>$orders,'path'=>$path,'config'=>$config,'imagen'=>$imagen,'currency'=>$currency,'queryStatus'=>$queryStatus,'queryPayment'=>$queryPayment,'desde'=>$desde,'hasta'=>$hasta,'ordersResume'=>$ordersResume]);

                return $pdf->download ('Orders_list'.$nompdf.'.pdf');
            }
            if ( $verpdf == "Browser" )
            {
                $pdf = PDF::loadView('admin.orders.pdf',['orders'=>$orders,'path'=>$path,'config'=>$config,'imagen'=>$imagen,'currency'=>$currency,'queryStatus'=>$queryStatus,'queryPayment'=>$queryPayment,'desde'=>$desde,'hasta'=>$hasta,'ordersResume'=>$ordersResume]);

                return $pdf->stream ('Orders_list'.$nompdf.'.pdf');
            }
        }
    }

    public function pdfshow(Request $request)
    {
        if ($request)
        {
            $idorder = $request->input('rorderid');
            $order = Order::where('id', $idorder)->first();
            $orderItems = DB::table('order_items as o')
            ->join('products as p','o.prod_id','=','p.id')
            ->join('categories as cat','p.cate_id','cat.id')
            ->where('o.order_id', $idorder)
            ->select('o.id','o.prod_id as ProdID','o.qty','o.price','p.name as Product','p.slug as ProdSlug','p.small_description','p.description','p.original_price','p.selling_price','p.image','p.tax','p.status','p.trending','o.discount','p.cate_id','cat.name as Category','cat.slug as CatSlug')
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
                $pdf = PDF::loadView('admin.orders.pdfshow',['order'=>$order,'orderItems'=>$orderItems,'path'=>$path,'config'=>$config,'imagen'=>$imagen,'currency'=>$currency]);

                return $pdf->download ($order->tracking_no.$nompdf.'.pdf');
            }
            if ( $verpdf == "Browser" )
            {
                $pdf = PDF::loadView('admin.orders.pdfshow',['order'=>$order,'orderItems'=>$orderItems,'path'=>$path,'config'=>$config,'imagen'=>$imagen,'currency'=>$currency]);

                return $pdf->stream ($order->tracking_no.$nompdf.'.pdf');
            }
        }
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\User;
use App\Http\Requests\UserFormRequest;
use Illuminate\Support\Facades\Auth;
use DB;

class UserController extends Controller
{
    public function indexorders()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        $cartProducts = Cart::where('user_id', Auth::id())->get();
        return view('frontend.orders.index', compact('orders','cartProducts'));
    }

    public function showorder($id)
    {
        $orders = Order::where('id', $id)->where('user_id', Auth::id())->first();
        $orderItems = DB::table('order_items as o')
        ->join('products as p','o.prod_id','=','p.id')
        ->join('categories as cat','p.cate_id','cat.id')
        ->where('o.order_id', $id)
        ->select('o.id','o.prod_id as ProdID','o.qty','o.price','p.name as Product','p.slug as ProdSlug','p.small_description','p.description','p.original_price','p.selling_price','p.image','p.tax','p.status','p.trending','o.discount','p.cate_id','cat.name as Category','cat.slug as CatSlug')
        ->orderBy('p.name','asc')
        ->get();
        return view('frontend.orders.show', compact('orders','orderItems'));
    }

    public function indexuser()
    {
        return view('frontend.user.index');
    }

    public function showuser($id)
    {
        $user = User::where('id', $id)->first();
        return view('frontend.user.show', compact('user'));
    }

    public function edituser($id)
    {
        $user = User::where('id', $id)->first();
        return view('frontend.user.edit', compact('user'));
    }

    public function updateuser(UserFormRequest $request, $id)
    {
        $user = User::find($id);
        // if($request->hasFile('image'))
        // {
        //     $path = 'assets/uploads/category/'.$user->image;
        //     if(File::exists($path))
        //     {
        //         File::delete($path);
        //     }
        //     $file = $request->file('image');
        //     $ext = $file->getClientOriginalExtension();
        //     $filename = time().'.'.$ext;
        //     $file->move('assets/uploads/category',$filename);
        //     $user->image = $filename;
        // }
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->address1 = $request->input('address1');
        $user->address2 = $request->input('address2');
        $user->city = $request->input('city');
        $user->state = $request->input('state');
        $user->country = $request->input('country');
        $user->zipcode = $request->input('zipcode');
        $user->update();

        return redirect('my-account')->with('status',"User Updated Successfully");
    }
}

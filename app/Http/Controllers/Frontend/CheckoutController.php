<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Http\Requests\OrderFormRequest;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $old_cartProducts = Cart::where('user_id', Auth::id())->get();
        foreach($old_cartProducts as $item)
        {
            if (!Product::where('id', $item->prod_id)->where('qty','>=',$item->prod_qty)->exists()) {
                $removeItem = Cart::where('user_id',Auth::id())->where('prod_id', $item->prod_id)->first();
                $removeItem->delete();
            }
        }

        $cartProducts = Cart::where('user_id', Auth::id())->get();

        return view('frontend.checkout', compact('cartProducts'));
    }

    public function placeorder(OrderFormRequest $request)
    {
        $order = new Order();
        $order->user_id = Auth::id();
        $order->fname = $request->input('fname');
        $order->lname = $request->input('lname');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->address1 = $request->input('address1');
        $order->address2 = $request->input('address2');
        $order->city = $request->input('city');
        $order->state = $request->input('state');
        $order->country = $request->input('country');
        $order->zipcode = $request->input('zipcode');
        $order->note = $request->input('note');
        $order->tracking_no = 'eshop'.rand(1111,9999);

        //Calculate total price
        $total = 0;
        $cartProducts_total = Cart::where('user_id', Auth::id())->get();
        foreach ($cartProducts_total as $cp) {
            if ($cp->products->discount == "1") {
                $price = $cp->products->selling_price;
            }else {
                $price = $cp->products->original_price;
            }
            $total += $price;
        }

        $order->total_price = $total;
        $order->save();



        $cartProducts = Cart::where('user_id', Auth::id())->get();
        foreach ($cartProducts as $item)
        {
            if ($item->products->discount == "1") {
                $price = $item->products->selling_price;
            }else {
                $price = $item->products->original_price;
            }
            OrderItem::create([
                'order_id' => $order->id,
                'prod_id' => $item->prod_id,
                'qty' => $item->prod_qty,
                'price' => $price,
                'discount' => $item->products->discount,
            ]);

            $prod = Product::where('id', $item->prod_id)->first();
            $prod->qty = $prod->qty - $item->prod_qty;
            $prod->update();
        }

            $user = User::where('id', Auth::id())->first();
            $user->name = $request->input('fname').' '.$request->input('lname');
            $user->phone = $request->input('phone');
            $user->address1 = $request->input('address1');
            $user->address2 = $request->input('address2');
            $user->city = $request->input('city');
            $user->state = $request->input('state');
            $user->country = $request->input('country');
            $user->zipcode = $request->input('zipcode');
            $user->update();

        $cartProducts = Cart::where('user_id', Auth::id())->get();
        Cart::destroy($cartProducts);

        return redirect('/')->with('status', "Order placed Sussesfully");
    }
}

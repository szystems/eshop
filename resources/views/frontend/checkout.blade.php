@extends('layouts.frontend')
{{-- Trending products --}}
@section('content')
    <div class="page-header text-center" style="background-image: url({{ asset('fronttemplate/assets/images/page-header-bg.jpg') }})">
        <div class="container">
            <h1 class="page-title">Checkout<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('cart') }}">Cart</a></li>
                <li class="breadcrumb-item"><a href="{{ url('checkout') }}">Checkout</a></li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="checkout">
            <div class="container">
                {{-- <div class="checkout-discount">
                    <form action="#">
                        <input type="text" class="form-control" required id="checkout-discount-input">
                        <label for="checkout-discount-input" class="text-truncate">Have a coupon? <span>Click here to enter your code</span></label>
                    </form>
                </div><!-- End .checkout-discount --> --}}
                <form action="{{  url('place-order') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-9">
                            <h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
                                @if (count($errors)>0)
                                    <div class="alert alert-danger text-white" role="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>First Name *</label>
                                        @php
                                            $usuario = Auth::user()->name; $nombre = explode(' ',trim($usuario));
                                            $names =str_word_count($usuario);
                                        @endphp

                                        <input type="text" name="fname" class="form-control" placeholder="Enter First Name" value="{{ ucwords($nombre[0]) }}">{{ str_word_count($usuario); }}
                                        @if ($errors->has('fname'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('fname') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>Last Name *</label>
                                        @if ($names > 1)
                                            <input type="text" name="lname" class="form-control" placeholder="Enter Last Name"  value="{{ ucwords($nombre[1]) }}">
                                        @else
                                            <input type="text" name="lname" class="form-control" placeholder="Enter Last Name">
                                        @endif
                                        @if ($errors->has('lname'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('lname') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>Email address *</label>
                                        <input type="email" name="email" class="form-control" placeholder="Enter Email" value="{{ Auth::user()->email }}">
                                        @if ($errors->has('email'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('email') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>Phone Number*</label>
                                        <input type="tel" name="phone" class="form-control" placeholder="Enter Phone Number" value="{{ Auth::user()->phone }}">
                                        @if ($errors->has('phone'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('phone') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->

                                </div><!-- End .row -->

                                {{-- <label>Company Name (Optional)</label>
                                <input type="text" class="form-control"> --}}

                                <label>Address 1 *</label>
                                <input type="text" name="address1" class="form-control" placeholder="House number and Street name" value="{{ Auth::user()->address1 }}">
                                @if ($errors->has('address1'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('address1') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                {{-- <input type="text" class="form-control" placeholder="Appartments, suite, unit etc ..." required> --}}

                                <label>Address 2</label>
                                <input type="text" name="address2" class="form-control" placeholder="House number and Street name (optional)" value="{{ Auth::user()->address2 }}">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Town / City *</label>
                                        <input type="text" name="city" class="form-control" placeholder="Enter Town / City" value="{{ Auth::user()->city }}">
                                        @if ($errors->has('city'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('city') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>State / County *</label>
                                        <input type="text" name="state" class="form-control" placeholder="Enter State / County" value="{{ Auth::user()->state }}">
                                        @if ($errors->has('state'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('state') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->

                                <div class="row">

                                    <div class="col-sm-6">
                                        <label>Country *</label>
                                        <input type="text" name="country" class="form-control" placeholder="Enter Country" value="{{ Auth::user()->country }}">
                                        @if ($errors->has('country'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('country') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>Postcode / ZIP *</label>
                                        <input type="text" name="zipcode" class="form-control" placeholder="Enter Postcode / ZIP" value="{{ Auth::user()->zipcode }}">
                                        @if ($errors->has('zipcode'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('zipcode') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->

                                </div><!-- End .row -->



                                {{-- <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkout-create-acc">
                                    <label class="custom-control-label" for="checkout-create-acc">Create an account?</label>
                                </div><!-- End .custom-checkbox -->

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkout-diff-address">
                                    <label class="custom-control-label" for="checkout-diff-address">Ship to a different address?</label>
                                </div><!-- End .custom-checkbox --> --}}

                                <label>Order notes (optional)</label>
                                <textarea class="form-control" name="note" cols="30" rows="4" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                        </div><!-- End .col-lg-9 -->
                        <aside class="col-lg-3">
                            <div class="summary">
                                <h3 class="summary-title">Your Order</h3><!-- End .summary-title -->

                                <table class="table table-summary">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach ($cartProducts as $item)
                                            @php
                                                if ($item->products->discount == "1") {
                                                    $price = $item->products->selling_price;
                                                }else {
                                                    $price = $item->products->original_price;
                                                }
                                            @endphp
                                            <tr>
                                                <td><a href="{{ url('category/'.$item->products->category->slug.'/'.$item->products->slug) }}">{{ $item->products->name }}</a></td>
                                                @if ($item->products->discount == "1")
                                                    <td>{{ $item->prod_qty }} x {{ number_format($item->products->selling_price,2, '.', ',') }} <strike>{{ number_format($item->products->original_price,2, '.', ',') }}</strike></td>
                                                @else
                                                    <td>{{ $item->prod_qty }} x {{ number_format($item->products->original_price,2, '.', ',') }}</td>
                                                @endif

                                            </tr>
                                            @php
                                                $total +=  $price * $item->prod_qty;
                                            @endphp
                                        @endforeach
                                        <tr class="summary-subtotal">
                                            <td>Subtotal:</td>
                                            <td>{{ number_format($total,2, '.', ',') }}</td>
                                        </tr><!-- End .summary-subtotal -->
                                        <tr>
                                            <td>Shipping:</td>
                                            <td>Free shipping</td>
                                        </tr>
                                        <tr class="summary-total">
                                            <td>Total:</td>
                                            <td>{{ number_format($total,2, '.', ',') }}</td>
                                        </tr><!-- End .summary-total -->
                                    </tbody>
                                </table><!-- End .table table-summary -->

                                <div class="accordion-summary" id="accordion-payment">
                                    <div class="card">
                                        <div class="card-header" id="heading-1">
                                            <h2 class="card-title">
                                                <a role="button" data-toggle="collapse" href="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                                                    Direct bank transfer
                                                </a>
                                            </h2>
                                        </div><!-- End .card-header -->
                                        <div id="collapse-1" class="collapse show" aria-labelledby="heading-1" data-parent="#accordion-payment">
                                            <div class="card-body">
                                                Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.
                                            </div><!-- End .card-body -->
                                        </div><!-- End .collapse -->
                                    </div><!-- End .card -->

                                    <div class="card">
                                        <div class="card-header" id="heading-2">
                                            <h2 class="card-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
                                                    Check payments
                                                </a>
                                            </h2>
                                        </div><!-- End .card-header -->
                                        <div id="collapse-2" class="collapse" aria-labelledby="heading-2" data-parent="#accordion-payment">
                                            <div class="card-body">
                                                Ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis.
                                            </div><!-- End .card-body -->
                                        </div><!-- End .collapse -->
                                    </div><!-- End .card -->

                                    <div class="card">
                                        <div class="card-header" id="heading-3">
                                            <h2 class="card-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
                                                    Cash on delivery
                                                </a>
                                            </h2>
                                        </div><!-- End .card-header -->
                                        <div id="collapse-3" class="collapse" aria-labelledby="heading-3" data-parent="#accordion-payment">
                                            <div class="card-body">Quisque volutpat mattis eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros.
                                            </div><!-- End .card-body -->
                                        </div><!-- End .collapse -->
                                    </div><!-- End .card -->

                                    <div class="card">
                                        <div class="card-header" id="heading-4">
                                            <h2 class="card-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                                                    PayPal <small class="float-right paypal-link">What is PayPal?</small>
                                                </a>
                                            </h2>
                                        </div><!-- End .card-header -->
                                        <div id="collapse-4" class="collapse" aria-labelledby="heading-4" data-parent="#accordion-payment">
                                            <div class="card-body">
                                                Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum.
                                            </div><!-- End .card-body -->
                                        </div><!-- End .collapse -->
                                    </div><!-- End .card -->

                                    <div class="card">
                                        <div class="card-header" id="heading-5">
                                            <h2 class="card-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-5" aria-expanded="false" aria-controls="collapse-5">
                                                    Credit Card (Stripe)
                                                    <img src="{{ asset('fronttemplate/assets/images/payments-summary.png') }}" alt="payments cards">
                                                </a>
                                            </h2>
                                        </div><!-- End .card-header -->
                                        <div id="collapse-5" class="collapse" aria-labelledby="heading-5" data-parent="#accordion-payment">
                                            <div class="card-body"> Donec nec justo eget felis facilisis fermentum.Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Lorem ipsum dolor sit ame.
                                            </div><!-- End .card-body -->
                                        </div><!-- End .collapse -->
                                    </div><!-- End .card -->
                                </div><!-- End .accordion -->

                                <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                    <span class="btn-text">Place Order</span>
                                    <span class="btn-hover-text">Proceed to Checkout</span>
                                </button>
                            </div><!-- End .summary -->
                        </aside><!-- End .col-lg-3 -->
                    </div><!-- End .row -->
                </form>
            </div><!-- End .container -->
        </div><!-- End .checkout -->
    </div><!-- End .page-content -->
@endsection


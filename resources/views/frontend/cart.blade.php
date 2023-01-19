@extends('layouts.frontend')
{{-- Trending products --}}
@section('content')
    <div class="page-header text-center" style="background-image: url({{ asset('fronttemplate/assets/images/page-header-bg.jpg') }})">
        <div class="container">
            <h1 class="page-title">Shopping Cart<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('cart') }}">Cart</a></li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="cart">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <table class="table table-cart table-mobile">
                            @php
                                $total = 0;
                            @endphp
                            @if ($cartitems->count() > 0)
                                <thead>
                                    <tr align="center">
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($cartitems as $prod)
                                        @php
                                            if ($prod->discount == "1") {
                                                $price = $prod->selling_price;
                                            }else {
                                                $price = $prod->original_price;
                                            }
                                        @endphp
                                        <tr class="product_data">
                                            <td class="product-col">
                                                <div class="product">
                                                    <figure class="product-media">
                                                        <a href="{{ url('category/'.$prod->CatSlug.'/'.$prod->ProdSlug) }}">
                                                            <img src="{{ asset('assets/uploads/product/'.$prod->image) }}"
                                                                alt="{{ $prod->Product }}">
                                                        </a>
                                                    </figure>

                                                    <h3 class="product-title">

                                                        <a href="{{ url('category/'.$prod->CatSlug.'/'.$prod->ProdSlug) }}">{{ $prod->Product }}</a>
                                                    </h3><!-- End .product-title -->
                                                </div><!-- End .product -->
                                            </td>
                                            @if ($prod->discount == "1")
                                                <td class="price-col" align="center">
                                                    <font color="ef837b">{{ number_format($prod->selling_price,2, '.', ',') }}</font>
                                                    <font color="cccccc"><strike>{{ number_format($prod->original_price,2, '.', ',') }}</strike></font>
                                                </td>
                                            @else
                                                <td class="price-col" align="center"><font color="ef837b">{{ number_format($prod->original_price,2, '.', ',') }}</font></td>
                                            @endif

                                            <td class="quantity-col">

                                                <div class="input-group text-center" style="wdth:130px;">
                                                    <input type="hidden" class="prod_id" value="{{ $prod->ProdID }}">
                                                    @if ( $prod->prod_qty >= $prod->qty)
                                                        @if ($prod->qty == 0)
                                                            <h6><font color="red"><strong>Out of Stock</strong></font></h6>
                                                        @elseif ($prod->qty >= $prod->prod_qty)
                                                            <button class="input-group-text changeQuantitymenos">-</button>
                                                            <input readonly type="text" name="quantity" class="form-control qty-input text-center" value="{{ $prod->prod_qty }}" >
                                                            <button disabled class="input-group-text changeQuantitymas">+</button>
                                                            @php
                                                                $total +=  $price * $prod->prod_qty;
                                                            @endphp
                                                            <p>Stock: <strong>{{ $prod->qty }}</strong></p>
                                                        @elseif (($prod->qty < $prod->prod_qty))
                                                            <button class="input-group-text changeQuantitymenos">-</button>
                                                            <input readonly type="text" name="quantity" class="form-control qty-input text-center" value="{{ $prod->prod_qty }}" >
                                                            <button disabled class="input-group-text changeQuantitymas">+</button>
                                                            @php
                                                                $total +=  $price * $prod->prod_qty;
                                                            @endphp
                                                            <h6><font color="orange"><strong>Exceeds stock</strong></font></h6>
                                                            <p>Stock: <strong>{{ $prod->qty }}</strong></p>
                                                        @endif

                                                    @elseif ($prod->qty > 0)
                                                        <button class="input-group-text changeQuantitymenos">-</button>
                                                        <input readonly type="text" name="quantity" class="form-control qty-input text-center" value="{{ $prod->prod_qty }}" >
                                                        <button  class="input-group-text changeQuantitymas">+</button>
                                                        <p>Stock: <strong>{{ $prod->qty }}</strong></p>
                                                    @php
                                                        $total +=  $price * $prod->prod_qty;
                                                    @endphp
                                                    @endif
                                                    @php
                                                        $subtotal =  $price * $prod->prod_qty;
                                                    @endphp
                                                </div>
                                            </td>

                                            <td class="total-col" align="right">{{ number_format($subtotal,2, '.', ',') }}</td>
                                            <td class="remove-col">
                                                <button class="btn-remove delete-cart-item"><i class="icon-close"></i></button>
                                            </td>
                                        </tr>

                                    @endforeach

                                </tbody>
                            @else
                                <h3>Cart is empty</h3>
                                <a href="{{ url('category') }}" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                            @endif

                        </table><!-- End .table table-wishlist -->

                        {{-- <div class="cart-bottom">
                            <div class="cart-discount">
                                <form action="#">
                                    <div class="input-group">
                                        <input type="text" class="form-control" required placeholder="coupon code">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary-2" type="submit"><i
                                                    class="icon-long-arrow-right"></i></button>
                                        </div><!-- .End .input-group-append -->
                                    </div><!-- End .input-group -->
                                </form>
                            </div><!-- End .cart-discount -->

                            <a href="#" class="btn btn-outline-dark-2"><span>UPDATE CART</span><i class="icon-refresh"></i></a>
                        </div><!-- End .cart-bottom --> --}}
                    </div><!-- End .col-lg-9 -->
                    <aside class="col-lg-3">
                        <div class="summary summary-cart">
                            <h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

                            <table class="table table-summary">
                                <tbody>
                                    <tr class="summary-subtotal">
                                        <td>Subtotal:</td>
                                        <td>{{ number_format($total,2, '.', ',') }}</td>
                                    </tr><!-- End .summary-subtotal -->
                                    {{-- <tr class="summary-shipping">
                                        <td>Shipping:</td>
                                        <td>&nbsp;</td>
                                    </tr>

                                    <tr class="summary-shipping-row">
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="free-shipping" name="shipping"
                                                    class="custom-control-input">
                                                <label class="custom-control-label" for="free-shipping">Free
                                                    Shipping</label>
                                            </div><!-- End .custom-control -->
                                        </td>
                                        <td>$0.00</td>
                                    </tr><!-- End .summary-shipping-row -->

                                    <tr class="summary-shipping-row">
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="standart-shipping" name="shipping"
                                                    class="custom-control-input">
                                                <label class="custom-control-label"
                                                    for="standart-shipping">Standart:</label>
                                            </div><!-- End .custom-control -->
                                        </td>
                                        <td>$10.00</td>
                                    </tr><!-- End .summary-shipping-row -->

                                    <tr class="summary-shipping-row">
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="express-shipping" name="shipping"
                                                    class="custom-control-input">
                                                <label class="custom-control-label"
                                                    for="express-shipping">Express:</label>
                                            </div><!-- End .custom-control -->
                                        </td>
                                        <td>$20.00</td>
                                    </tr><!-- End .summary-shipping-row -->

                                    <tr class="summary-shipping-estimate">
                                        <td>Estimate for Your Country<br> <a href="dashboard.html">Change address</a></td>
                                        <td>&nbsp;</td>
                                    </tr><!-- End .summary-shipping-estimate --> --}}

                                    <tr class="summary-total">
                                        <td>Total:</td>
                                        <td>{{ number_format($total,2, '.', ',') }}</td>
                                    </tr><!-- End .summary-total -->
                                </tbody>
                            </table><!-- End .table table-summary -->
                            @if ($cartitems->count() > 0)
                                @php
                                    $outofstock = 0;
                                    foreach($cartitems as $item)
                                    {
                                        if ($item->qty < $item->prod_qty) {
                                            $outofstock++;
                                        }
                                    }
                                @endphp
                                @if ($outofstock > 0)
                                    <a href="{{ url('checkout') }}" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
                                    <div class="alert alert-danger" role="alert">
                                        You have <strong>{{ $outofstock }}</strong> item(s) out of stock, if you proceed it will be removed from your cart.
                                    </div>
                                @else
                                    <a href="{{ url('checkout') }}" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
                                @endif

                            @endif

                        </div><!-- End .summary -->

                        <a href="{{ url('category') }}" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .cart -->
    </div><!-- End .page-content -->
@endsection


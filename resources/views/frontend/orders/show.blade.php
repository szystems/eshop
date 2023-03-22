@extends('layouts.frontend')
{{-- Trending products --}}
@section('content')
    <div class="page-header text-center" style="background-image: url({{ asset('fronttemplate/assets/images/page-header-bg.jpg') }})">
        <div class="container">
            <h1 class="page-title">My Account<span>Order View</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('') }}">My Account</a></li>
                <li class="breadcrumb-item"><a href="{{ url('my-orders') }}">Orders</a></li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    <aside class="col-md-2 col-lg-2">
                        <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                             <li class="nav-item">
                                <a class="nav-link"  href="{{ url('my-account') }}">Welcome</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link"  href="{{ url('cart') }}">Cart</a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link active"  href="{{ url('my-orders') }}">Orders</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link"  href="#">Adresses</a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link"  href="{{ url('user-details/'.Auth::id()) }}">Account Details</a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:; {{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </aside><!-- End .col-lg-3 -->

                    <div class="col-md-10 col-lg-10">
                        <div class="tab-content">

                            <div class="tab-pane fade show active">
                                {{-- <p>Hello <span class="font-weight-normal text-dark">User</span> (not <span class="font-weight-normal text-dark">User</span>? <a href="#">Log out</a>)
                                <br>
                                From your account dashboard you can view your <a href="#tab-orders" class="tab-trigger-link link-underline">recent orders</a>, manage your <a href="#tab-address" class="tab-trigger-link">shipping and billing addresses</a>, and <a href="#tab-account" class="tab-trigger-link">edit your password and account details</a>.</p> --}}
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h5><font color="cc9c94"><strong><u>Order Details: </u></strong></font></h5>
                                    </div><!-- End .col-sm-6 -->
                                    <div class="col-sm-3">
                                        <label><strong>First Name</strong></label>
                                        <p>{{ $orders->fname }}</p>
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-3">
                                        <label><strong>Last Name</strong></label>
                                        <p>{{ $orders->lname }}</p>
                                    </div><!-- End .col-sm-6 -->
                                    <div class="col-sm-3">
                                        <label><strong>Email</strong></label>
                                        <p>{{ $orders->email }}</p>
                                    </div><!-- End .col-sm-6 -->
                                    <div class="col-sm-3">
                                        <label><strong>Phone</strong></label>
                                        <p>{{ $orders->phone }}</p>
                                    </div><!-- End .col-sm-6 -->
                                    <div class="col-sm-12">
                                        <label><strong>Shipping Address</strong></label>
                                        <p>
                                            {{ $orders->address1 }},
                                            @if($orders->address2 != null)
                                                {{ $orders->address2 }}
                                            @endif
                                            {{ $orders->city }},
                                            {{ $orders->state }},
                                            {{ $orders->country }}.
                                        </p>
                                    </div><!-- End .col-sm-6 -->
                                    <div class="col-sm-3">
                                        <label><strong>Zip Code</strong></label>
                                        <p>{{ $orders->zipcode }}</p>
                                    </div><!-- End .col-sm-6 -->
                                    <div class="col-sm-3">
                                        <label><strong>Status</strong></label>
                                        <p>{{ $orders->status == '0' ?'Pending' : 'Completed' }}</p>
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-3">
                                        <label><strong>Tracking No.</strong></label>
                                        <p>{{ $orders->tracking_no }}</p>
                                    </div><!-- End .col-sm-6 -->
                                    <div class="col-sm-3">
                                        <label><strong>Order Date <small>({{ Auth::user()->timezone }})</small></strong></label>
                                        @php
                                            $date = new DateTime($orders->created_at, new DateTimeZone(date_default_timezone_get()));
                                            $date->setTimezone(new DateTimeZone(Auth::user()->timezone));
                                        @endphp
                                        <p>{{ $date->format('d-m-Y')}}</p>
                                    </div><!-- End .col-sm-6 -->
                                    @if ($orders->note != null)
                                        <div class="col-sm-12">
                                            <label><strong>Note</strong></label>
                                            <p>{{ $orders->note }}</p>
                                        </div><!-- End .col-sm-6 -->
                                    @endif
                                    @if ($orders->payment_mode != null)
                                        <div class="col-sm-3">
                                            <label><strong>Payment Mode</strong></label>
                                            <p>{{ $orders->payment_mode }}</p>
                                        </div><!-- End .col-sm-6 -->
                                    @endif
                                    @if ($orders->payment_id != null)
                                        <div class="col-sm-3">
                                            <label><strong>Payment ID</strong></label>
                                            <p>{{ $orders->payment_id }}</p>
                                        </div><!-- End .col-sm-6 -->
                                    @endif


                                </div><!-- End .row -->
                                <div class="row">
                                    <h5><font color="cc9c94"><strong><u>Products:</u></strong></font></h5>
                                    <table class="table table-cart table-mobile">
                                        @php
                                            $total = 0;
                                        @endphp

                                        <thead>
                                            <tr align="center">
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>SubTotal</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            @foreach ($orderItems as $item)
                                                @php
                                                    if ($item->discount == "1") {
                                                        $price = $item->selling_price;
                                                    }else {
                                                        $price = $item->original_price;
                                                    }
                                                @endphp
                                                <tr class="product_data">
                                                    <td class="product-col">
                                                        <div class="product">
                                                            <figure class="product-media">
                                                                <a href="{{ url('category/'.$item->CatSlug.'/'.$item->ProdSlug) }}">
                                                                    <img src="{{ asset('assets/uploads/product/'.$item->image) }}"
                                                                        alt="{{ $item->Product }}">
                                                                </a>
                                                            </figure>

                                                            <h3 class="product-title">

                                                                <a href="{{ url('category/'.$item->CatSlug.'/'.$item->ProdSlug) }}">{{ $item->Product }}</a>
                                                            </h3><!-- End .product-title -->
                                                        </div><!-- End .product -->
                                                    </td>
                                                    @if ($item->discount == "1")
                                                        <td class="price-col" align="center">
                                                            <font color="ef837b">{{ $config->currency_simbol }}{{ number_format($item->price,2, '.', ',') }}</font>
                                                            <font color="cccccc"><strike>{{ $config->currency_simbol }}{{ number_format($item->original_price,2, '.', ',') }}</strike></font>
                                                        </td>
                                                    @else
                                                        <td class="price-col" align="center"><font color="ef837b">{{ $config->currency_simbol }}{{ number_format($item->price,2, '.', ',') }}</font></td>
                                                    @endif

                                                    <td class="quantity-col text-center">
                                                            {{ $item->qty }}
                                                            @php
                                                                $total +=  $price * $item->qty;
                                                                $subtotal =  $price * $item->qty;
                                                            @endphp
                                                    </td>

                                                    <td class="total-col" align="right">{{ $config->currency_simbol }}{{ number_format($subtotal,2, '.', ',') }}</td>
                                                </tr>

                                            @endforeach

                                        </tbody>

                                        <tfoot>
                                            @if ($orders->total_tax != 0)
                                                <tr>
                                                    @php
                                                        $tax_total = $orders->total_tax;
                                                        $total = $total + $tax_total;
                                                    @endphp
                                                    <td></td>
                                                    <td></td>
                                                    <td align="center"><h8>Tax: </h8></td>
                                                    <td align="right"><h8><font color="cc9c94"> {{ $config->currency_simbol }}{{ number_format($tax_total,2, '.', ',') }}</font></h8></td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td align="center"><h4>Total: </h4></td>
                                                <td align="right"><h4><font color="cc9c94"> {{ $config->currency_simbol }}{{ number_format($total,2, '.', ',') }}</font></h4></td>
                                            </tr>
                                        </tfoot>

                                    </table><!-- End .table table-wishlist -->
                                </div>
                            </div><!-- .End .tab-pane -->

                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
@endsection


@extends('layouts.frontend')
{{-- Trending products --}}
@section('content')
    <div class="page-header text-center" style="background-image: url({{ asset('fronttemplate/assets/images/page-header-bg.jpg') }})">
        <div class="container">
            <h1 class="page-title">My Account<span>Orders</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('my-account') }}">My Account</a></li>
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
                                <table class="table table-cart table-mobile">
									<thead>
										<tr>
                                            <th>Order Date <small>({{ Auth::user()->timezone }})</small></th>
											<th>Tracking Number</th>
											<th>Total</th>
                                            <th>Status</th>
											<th>Action</th>
										</tr>
									</thead>

									<tbody>

                                        @foreach ($orders as $item)
                                            <tr>
                                                @php
                                                    $date = new DateTime($item->created_at, new DateTimeZone(date_default_timezone_get()));
                                                    $date->setTimezone(new DateTimeZone(Auth::user()->timezone));
                                                @endphp
                                                <td>{{ $date->format('d-m-Y') }}</td>
                                                <td class="product-col">
                                                    <div class="product">
                                                        <h3 class="product-title">
                                                            <a href="#">{{ $item->tracking_no }}</a>
                                                        </h3><!-- End .product-title -->
                                                    </div><!-- End .product -->
                                                </td>
                                                <td class="total-col">{{ $config->currency_simbol }}{{ number_format($item->total_price,2, '.', ',') }}</td>
                                                <td class="quantity-col">{{ $item->status == '0' ?'Pending' : 'Completed' }}</td>
                                                <td class="remove-col">
                                                    <a href="{{ url('view-order/'.$item->id) }}" class="btn btn-outline-primary-2"><i class="icon-eye"></i><span>View</span></a>
                                                </td>
                                            </tr>
                                        @endforeach

									</tbody>
								</table><!-- End .table table-wishlist -->
                            </div><!-- .End .tab-pane -->

                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
@endsection


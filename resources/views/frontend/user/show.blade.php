@extends('layouts.frontend')
{{-- Trending products --}}
@section('content')
    <div class="page-header text-center" style="background-image: url({{ asset('fronttemplate/assets/images/page-header-bg.jpg') }})">
        <div class="container">
            <h1 class="page-title">My Account<span>Account Details</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('') }}">My Account</a></li>
                <li class="breadcrumb-item"><a href="{{ url('user-details/'.Auth::id()) }}">Account Details</a></li>
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
                                <a class="nav-link"  href="{{ url('my-orders') }}">Orders</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link"  href="#">Adresses</a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link active"  href="{{ url('user-details/'.Auth::id()) }}">Account Details</a>
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

                                <a type="button" href="{{ url('user-edit/'.Auth::id()) }}" class="btn btn-outline-primary-2">
                                    <span>EDIT</span>
                                    <i class="icon-long-arrow-right"></i>
                                </a>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>Name</label>
                                        <input readonly name="name" type="text" class="form-control" value="{{ $user->name }}">
                                    </div><!-- End .col-sm-6 -->
                                    <div class="col-sm-4">
                                        <label>Phone</label>
                                        <input readonly name="phone" type="text" class="form-control" value="{{ $user->phone }}">
                                    </div><!-- End .col-sm-6 -->
                                    <div class="col-sm-4">
                                        <label>Email</label>
                                        <input readonly name="email" type="text" class="form-control" value="{{ $user->email }}">
                                        <small class="form-text">You can't change email</small>
                                    </div><!-- End .col-sm-6 -->
                                    <div class="col-sm-6">
                                        <label>Address 1</label>
                                        <input readonly name="address1" type="text" class="form-control" value="{{ $user->address1 }}">
                                    </div><!-- End .col-sm-6 -->
                                    <div class="col-sm-6">
                                        <label>Address 2</label>
                                        <input readonly name="address2" type="text" class="form-control" value="{{ $user->address2 }}">
                                    </div><!-- End .col-sm-6 -->
                                    <div class="col-sm-3">
                                        <label>City</label>
                                        <input readonly name="city" type="text" class="form-control" value="{{ $user->city }}">
                                    </div><!-- End .col-sm-6 -->
                                    <div class="col-sm-3">
                                        <label>State</label>
                                        <input readonly name="state" type="text" class="form-control" value="{{ $user->state }}">
                                    </div><!-- End .col-sm-6 -->
                                    <div class="col-sm-3">
                                        <label>Country</label>
                                        <input readonly name="country" type="text" class="form-control" value="{{ $user->country }}">
                                    </div><!-- End .col-sm-6 -->
                                    <div class="col-sm-3">
                                        <label>Zipcode</label>
                                        <input readonly name="zipcode" type="text" class="form-control" value="{{ $user->zipcode }}">
                                    </div><!-- End .col-sm-6 -->
                                    <div class="col-sm-3">
                                        <label>Timezone</label>
                                        <input readonly name="zipcode" type="text" class="form-control" value="{{ $user->timezone }}">
                                    </div><!-- End .col-sm-6 -->
                                </div>
                            </div><!-- .End .tab-pane -->

                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
@endsection


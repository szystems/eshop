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
                                <a class="nav-link active"  href="{{ url('orders-details/'.Auth::id()) }}">Account Details</a>
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
                                <h4>Edit User Details</h4>
                                @if (count($errors)>0)
                                    <div class="alert alert-danger text-white" role="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    </div>

                                @endif
                                <form action="{{ url('user-update/'.Auth::id()) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>Name</label>
                                            <input  name="name" type="text" class="form-control" value="{{ $user->name }}">
                                            @if ($errors->has('name'))
                                                <span class="help-block opacity-7">
                                                        <strong>
                                                            <font color="red">{{ $errors->first('name') }}</font>
                                                        </strong>
                                                </span>
                                            @endif
                                        </div><!-- End .col-sm-6 -->
                                        <div class="col-sm-4">
                                            <label>Phone</label>
                                            <input name="phone" type="text" class="form-control" value="{{ $user->phone }}">
                                            @if ($errors->has('phone'))
                                                <span class="help-block opacity-7">
                                                        <strong>
                                                            <font color="red">{{ $errors->first('phone') }}</font>
                                                        </strong>
                                                </span>
                                            @endif
                                        </div><!-- End .col-sm-6 -->
                                        <div class="col-sm-4">
                                            <label>Email</label>
                                            <input readonly name="email" type="text" class="form-control" value="{{ $user->email }}">
                                            <small class="form-text">You can't change email</small>
                                            @if ($errors->has('email'))
                                                <span class="help-block opacity-7">
                                                        <strong>
                                                            <font color="red">{{ $errors->first('email') }}</font>
                                                        </strong>
                                                </span>
                                            @endif
                                        </div><!-- End .col-sm-6 -->
                                        <div class="col-sm-6">
                                            <label>Address 1</label>
                                            <input name="address1" type="text" class="form-control" value="{{ $user->address1 }}">
                                            @if ($errors->has('address1'))
                                                <span class="help-block opacity-7">
                                                        <strong>
                                                            <font color="red">{{ $errors->first('address1') }}</font>
                                                        </strong>
                                                </span>
                                            @endif
                                        </div><!-- End .col-sm-6 -->
                                        <div class="col-sm-6">
                                            <label>Address 2</label>
                                            <input name="address2" type="text" class="form-control" value="{{ $user->address2 }}">
                                            @if ($errors->has('address2'))
                                                <span class="help-block opacity-7">
                                                        <strong>
                                                            <font color="red">{{ $errors->first('address2') }}</font>
                                                        </strong>
                                                </span>
                                            @endif
                                        </div><!-- End .col-sm-6 -->
                                        <div class="col-sm-3">
                                            <label>City</label>
                                            <input name="city" type="text" class="form-control" value="{{ $user->city }}">
                                            @if ($errors->has('city'))
                                                <span class="help-block opacity-7">
                                                        <strong>
                                                            <font color="red">{{ $errors->first('city') }}</font>
                                                        </strong>
                                                </span>
                                            @endif
                                        </div><!-- End .col-sm-6 -->
                                        <div class="col-sm-3">
                                            <label>State</label>
                                            <input name="state" type="text" class="form-control" value="{{ $user->state }}">
                                            @if ($errors->has('state'))
                                                <span class="help-block opacity-7">
                                                        <strong>
                                                            <font color="red">{{ $errors->first('state') }}</font>
                                                        </strong>
                                                </span>
                                            @endif
                                        </div><!-- End .col-sm-6 -->
                                        <div class="col-sm-3">
                                            <label>Country</label>
                                            <input name="country" type="text" class="form-control" value="{{ $user->country }}">
                                            @if ($errors->has('country'))
                                                <span class="help-block opacity-7">
                                                        <strong>
                                                            <font color="red">{{ $errors->first('country') }}</font>
                                                        </strong>
                                                </span>
                                            @endif
                                        </div><!-- End .col-sm-6 -->
                                        <div class="col-sm-3">
                                            <label>Zipcode</label>
                                            <input name="zipcode" type="text" class="form-control" value="{{ $user->zipcode }}">
                                            @if ($errors->has('zipcode'))
                                                <span class="help-block opacity-7">
                                                        <strong>
                                                            <font color="red">{{ $errors->first('zipcode') }}</font>
                                                        </strong>
                                                </span>
                                            @endif
                                        </div><!-- End .col-sm-6 -->
                                    </div>

                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>SAVE</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </form>
                            </div><!-- .End .tab-pane -->

                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
@endsection


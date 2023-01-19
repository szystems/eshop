@extends('layouts.frontend')
{{-- Trending products --}}
@section('content')
    <div class="page-header text-center" style="background-image: url({{ asset('fronttemplate/assets/images/page-header-bg.jpg') }})">
        <div class="container">
            @php
                $usuario = Auth::user()->name; $nombre = explode(' ',trim($usuario));
                $names =str_word_count($usuario);
            @endphp
            <h1 class="page-title">My Account<span>{{ Auth::user()->name }}</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('my-account') }}">My Account</a></li>
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
                                <a class="nav-link active"  href="{{ url('my-account') }}">Welcome</a>
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
                                <p>Hello <span class="font-weight-normal text-dark">{{ ucwords($nombre[0]) }},</span> not <span class="font-weight-normal text-dark">User</span>?
                                    <a href="javascript:; {{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                <br>
                                From your account dashboard you can view your <a href="{{ url('my-orders') }}" class="tab-trigger-link link-underline">recent orders</a>, manage your <a href="#tab-address" class="tab-trigger-link">shipping and billing addresses</a>, and <a href="#tab-account" class="tab-trigger-link">edit your password and account details</a>.</p>

                            </div><!-- .End .tab-pane -->

                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
@endsection


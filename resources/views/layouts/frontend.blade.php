<!DOCTYPE html>
<html lang="en">


<!-- molla/index-2.html') }}  22 Nov 2019 09:55:32 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>E-Shop</title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="E-Shop">
    <meta name="author" content="Szystems">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('fronttemplate/assets/images/icons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('fronttemplate/assets/images/icons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('fronttemplate/assets/images/icons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('fronttemplate/assets/images/icons/site.html') }}">
    <link rel="mask-icon" href="{{ asset('fronttemplate/assets/images/icons/safari-pinned-tab.svg') }}" color="#666666">
    <link rel="shortcut icon" href="{{ asset('fronttemplate/assets/images/icons/favicon.ico') }}">
    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="{{ asset('fronttemplate/assets/images/icons/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('fronttemplate/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fronttemplate/assets/css/plugins/owl-carousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('fronttemplate/assets/css/plugins/magnific-popup/magnific-popup.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('fronttemplate/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fronttemplate/assets/css/plugins/nouislider/nouislider.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    {{-- <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet"> --}}
</head>

<body>
    <div class="page-wrapper">
        <header class="header">


            <div class="header-middle sticky-header">
                <div class="container">
                    <div class="header-left">
                        <button class="mobile-menu-toggler">
                            <span class="sr-only">Toggle mobile menu</span>
                            <i class="icon-bars"></i>
                        </button>

                        <a href="index.html') }}" class="logo">
                            <img src="{{ asset('fronttemplate/assets/images/logo.png') }}" alt="Molla Logo" width="105" height="25">
                        </a>

                        <nav class="main-nav">
                            <ul class="menu sf-arrows">
                                <li class="">
                                    <a href="{{ url('/') }}">Home</a>
                                </li>
                                <li>
                                    <a href="{{ url('category') }}" class="sf-with-ul">Category</a>
                                    @php
                                        $categories=DB::table('categories')
                                        ->where('status','=','1')
                                        ->orderBy('name','asc')
                                        ->get();
                                    @endphp
                                    <ul>
                                        @foreach ($categories as $cat)
                                            <li><a href="{{ url('view-category/'.$cat->slug) }}">{{ $cat->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul><!-- End .menu -->
                        </nav><!-- End .main-nav -->
                    </div><!-- End .header-left -->

                    <div class="header-right">
                        <div class="header-search">
                            <form action="{{ url('buscarproducto') }}" method="POST">
                                {{ csrf_field() }}
                                <a  class="search-toggle active" role="button" title="Search"><i class="icon-search"></i></a>
                                <div class="header-search-wrapper show">
                                    <label class="sr-only">Search</label>
                                    <input type="search" class="form-control" name="product_name" id="search_product" placeholder="Search Products..." required>
                                </div><!-- End .header-search-wrapper -->
                            </form>

                        </div><!-- End .header-search -->
                        @if (Auth::guest())
                            <div class="dropdown cart-dropdown">
                                <a href="" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                    <i class="icon-shopping-cart"></i>
                                    <span class="cart-count cart-count-pill">0</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    {{-- <div class="dropdown-cart-products">
                                        <div class="product">
                                            <div class="product-cart-details">
                                                <h4 class="product-title">
                                                    <a href="product.html') }}">Beige knitted elastic runner shoes</a>
                                                </h4>

                                                <span class="cart-product-info">
                                                    <span class="cart-product-qty">1</span>
                                                    x $84.00
                                                </span>
                                            </div><!-- End .product-cart-details -->

                                            <figure class="product-image-container">
                                                <a href="product.html') }}" class="product-image">
                                                    <img src="{{ asset('fronttemplate/assets/images/products/cart/product-1.jpg') }}" alt="product">
                                                </a>
                                            </figure>
                                            <a href="" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                                        </div><!-- End .product -->

                                        <div class="product">
                                            <div class="product-cart-details">
                                                <h4 class="product-title">
                                                    <a href="product.html') }}">Blue utility pinafore denim dress</a>
                                                </h4>

                                                <span class="cart-product-info">
                                                    <span class="cart-product-qty">1</span>
                                                    x $76.00
                                                </span>
                                            </div><!-- End .product-cart-details -->

                                            <figure class="product-image-container">
                                                <a href="product.html') }}" class="product-image">
                                                    <img src="{{ asset('fronttemplate/assets/images/products/cart/product-2.jpg') }}" alt="product">
                                                </a>
                                            </figure>
                                            <a href="" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                                        </div><!-- End .product -->
                                    </div><!-- End .cart-product -->

                                    <div class="dropdown-cart-total">
                                        <span>Total</span>

                                        <span class="cart-total-price">$160.00</span>
                                    </div><!-- End .dropdown-cart-total --> --}}

                                    <div class="dropdown-cart-action">
                                        <a href="{{ route('login') }}" class="btn btn-primary">Login <span class="material-symbols-outlined">login</span></a>
                                        <a href="{{ route('register') }}" class="btn btn-outline-primary-2"><span>Register</span><span class="material-symbols-outlined">app_registration</span></a>
                                    </div><!-- End .dropdown-cart-total -->
                                </div><!-- End .dropdown-menu -->
                            </div><!-- End .cart-dropdown -->
                        @else
                            <div class="cart-dropdown">
                                <a href="{{ url('wishlist') }}" class="dropdown-toggle"  aria-haspopup="true" aria-expanded="false" data-display="static">
                                    <i class="icon-heart-o"></i>
                                    {{-- @php
                                        $wishNum=DB::table('wishlists')
                                        ->where('user_id','=',Auth::id())
                                        ->get();
                                    @endphp --}}
                                    {{-- <span class="wish-count">0</span> --}}
                                    <h6><span class="position-absolute badge badge-pill bg-secondary wish-count top-20 ">0</span></h6>
                                </a>
                            </div><!-- End .cart-dropdown -->
                            <div class="dropdown cart-dropdown">
                                <a href="" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                    <i class="icon-shopping-cart"></i>
                                    {{-- @php
                                        $cartNum=DB::table('carts')
                                        ->where('user_id','=',Auth::id())
                                        ->get();
                                    @endphp --}}
                                    <span class="cart-count cart-count-pill">0</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    @php
                                    $totalCart = 0;
                                        $cartitems = DB::table('carts as c')
                                        ->join('products as p','c.prod_id','=','p.id')
                                        ->join('categories as cat','p.cate_id','cat.id')
                                        ->where('c.user_id',Auth::id())
                                        ->select('c.id','c.user_id','c.prod_id as ProdID','c.prod_qty','p.name as Product','p.slug as ProdSlug','p.small_description','p.description','p.original_price','p.selling_price','p.image','p.qty','p.tax','p.status','p.trending','p.discount','p.cate_id','cat.name as Category','cat.slug as CatSlug')
                                        ->orderBy('p.name','asc')
                                        ->get();
                                    @endphp
                                    <div class="dropdown-cart-products">
                                        @if ($cartitems->count() > 0)
                                            @foreach ($cartitems as $prod)
                                                @php
                                                    if ($prod->discount == "1") {
                                                        $price = $prod->selling_price;
                                                    }else {
                                                        $price = $prod->original_price;
                                                    }
                                                @endphp
                                                <div class="product product_data">
                                                    <div class="product-cart-details">
                                                        <h4 class="product-title">
                                                            <input type="hidden" class="prod_id" value="{{ $prod->ProdID }}">
                                                            <a href="{{ url('category/'.$prod->CatSlug.'/'.$prod->ProdSlug) }}">{{ $prod->Product }}</a>
                                                        </h4>

                                                        <span class="cart-product-info">
                                                            <span class="cart-product-qty">{{ $prod->prod_qty }}</span>
                                                            x @if ($prod->discount == "1")
                                                                {{ number_format($prod->selling_price,2, '.', ',') }} <strike>{{ number_format($prod->original_price,2, '.', ',') }}</strike>
                                                            @else
                                                                {{ number_format($prod->original_price,2, '.', ',') }}
                                                            @endif
                                                        </span>
                                                    </div><!-- End .product-cart-details -->

                                                    <figure class="product-image-container">
                                                        <a href="{{ url('category/'.$prod->CatSlug.'/'.$prod->ProdSlug) }}" class="product-image">
                                                            <img src="{{ asset('assets/uploads/product/'.$prod->image) }}" alt="{{ $prod->Product }}">
                                                        </a>
                                                    </figure>
                                                    <button class="btn-remove delete-cart-item"><i class="icon-close"></i></button>
                                                </div><!-- End .product -->
                                                @php
                                                    $totalCart +=  $price * $prod->prod_qty;
                                                @endphp
                                            @endforeach
                                        @else
                                            <div>Cart is empty.</div>
                                        @endif

                                    </div><!-- End .cart-product -->

                                    <div class="dropdown-cart-total">
                                        <span>Total</span>

                                        <span class="cart-total-price">{{ number_format($totalCart,2, '.', ',') }}</span>
                                    </div><!-- End .dropdown-cart-total -->

                                    <div class="dropdown-cart-action">
                                        <a href="{{ url('cart') }}" class="btn btn-primary">View Cart</a>
                                        @php
                                            $outofstock = 0;
                                            foreach($cartitems as $item)
                                            {
                                                if ($item->qty < $item->prod_qty) {
                                                    $outofstock++;
                                                }
                                            }
                                        @endphp

                                        @if ($cartitems->count() > 0)
                                            @if ($outofstock > 0)
                                                <a href="{{ url('checkout') }}" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
                                                <br>
                                            @else
                                                <a href="{{ url('checkout') }}" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
                                            @endif

                                        @endif

                                    </div><!-- End .dropdown-cart-total -->
                                    @if ($outofstock > 0)
                                        <div class="alert alert-danger" role="alert">
                                            You have <strong>{{ $outofstock }}</strong> item(s) out of stock, if you proceed it will be removed from your <a href="{{ url('cart') }}">cart</a>.
                                        </div>
                                    @endif

                                </div><!-- End .dropdown-menu -->
                            </div><!-- End .cart-dropdown -->

                        @endif

                        <div class="dropdown cart-dropdown">
                            <a href="" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                <i class="icon-user"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                                {{-- <div class="dropdown-cart-products">


                                    <div class="product">
                                        <div class="product-cart-details">
                                            <h5><a href="product.html') }}"><span class="material-symbols-outlined">login</span> Login</a></h5>
                                        </div><!-- End .product-cart-details -->
                                    </div><!-- End .product -->

                                </div><!-- End .cart-product -->

                                <div class="dropdown-cart-total">
                                    <span>Total</span>

                                    <span class="cart-total-price">$160.00</span>
                                </div><!-- End .dropdown-cart-total --> --}}
                                @if (Auth::guest())
                                    <div class="dropdown-cart-action">
                                        <a href="{{ route('login') }}" class="btn btn-primary">Login <span class="material-symbols-outlined">login</span></a>
                                        <a href="{{ route('register') }}" class="btn btn-outline-primary-2"><span>Register</span><span class="material-symbols-outlined">app_registration</span></a>
                                    </div><!-- End .dropdown-cart-total -->
                                @else
                                    <div class="dropdown">
                                        <ul>
                                            <li>
                                                <p><a href="{{ url('my-account') }}"><i class="icon-user"></i><font color="black"> My Account</font></a></p>
                                            </li>
                                            <li>
                                                <p><a href="{{ url('wishlist') }}"><i class="icon-heart-o"></i><font color="black"> Whishlist <span class="badge badge-secondary wish-count"></span> </font></a></p>
                                            </li>
                                            <li>
                                                <p><a href="{{ url('cart') }}"><i class="icon-shopping-cart"></i><font color="black"> Cart <span class="badge badge-secondary cart-count-pill"></span></font></a></p>
                                            </li>
                                            <li>
                                                <p><a href="{{ url('my-orders') }}"><i class="icon-bars"></i><font color="black"> Orders </font></a></p>
                                            </li>
                                            @if (Auth::user()->role_as == "1")
                                                <li>
                                                    <p><a href="{{ url('dashboard') }}"><i class="icon-laptop"></i><font color="black"> Admin Dashboard </font></a></p>
                                                </li>
                                            @endif

                                        </ul>
                                    </div><!-- End .dropdown-cart-total -->
                                    <div class="dropdown-cart-action">
                                        <a href="javascript:; {{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-primary">logout <span class="material-symbols-outlined">logout</span></a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div><!-- End .dropdown-cart-total -->
                                @endif
                            </div><!-- End .dropdown-menu -->
                        </div><!-- End .user-dropdown -->
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-middle -->
        </header><!-- End .header -->

        <main class="main">
            @yield('content')
        </main><!-- End .main -->

        @include('layouts.incfront.frontfooter')

    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    @include('layouts.incfront.mobilmenu')

    @include('layouts.incfront.loginmodal')

    {{-- <div class="container newsletter-popup-container mfp-hide" id="newsletter-popup-form">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="row no-gutters bg-white newsletter-popup-content">
                    <div class="col-xl-3-5col col-lg-7 banner-content-wrap">
                        <div class="banner-content text-center">
                            <img src="{{ asset('fronttemplate/assets/images/popup/newsletter/logo.png') }}" class="logo" alt="logo" width="60" height="15">
                            <h2 class="banner-title">get <span>25<light>%</light></span> off</h2>
                            <p>Subscribe to the Molla eCommerce newsletter to receive timely updates from your favorite products.</p>
                            <form action="#">
                                <div class="input-group input-group-round">
                                    <input type="email" class="form-control form-control-white" placeholder="Your Email Address" aria-label="Email Adress" required>
                                    <div class="input-group-append">
                                        <button class="btn" type="submit"><span>go</span></button>
                                    </div><!-- .End .input-group-append -->
                                </div><!-- .End .input-group -->
                            </form>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="register-policy-2" required>
                                <label class="custom-control-label" for="register-policy-2">Do not show this popup again</label>
                            </div><!-- End .custom-checkbox -->
                        </div>
                    </div>
                    <div class="col-xl-2-5col col-lg-5 ">
                        <img src="{{ asset('fronttemplate/assets/images/popup/newsletter/img-1.jpg') }}" class="newsletter-img" alt="newsletter">
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Plugins JS File -->
    <script src="{{ asset('fronttemplate/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('fronttemplate/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('fronttemplate/assets/js/jquery.hoverIntent.min.js') }}"></script>
    <script src="{{ asset('fronttemplate/assets/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('fronttemplate/assets/js/superfish.min.js') }}"></script>
    <script src="{{ asset('fronttemplate/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('fronttemplate/assets/js/bootstrap-input-spinner.js') }}"></script>
    <script src="{{ asset('fronttemplate/assets/js/jquery.elevateZoom.min.js') }}"></script>
    <script src="{{ asset('fronttemplate/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
    <script src="{{ asset('frontend/js/checkout.js') }}"></script>
    <!-- Main JS File -->
    <script src="{{ asset('fronttemplate/assets/js/main.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>

        var availableTags = [];
        $.ajax({
            method: "GET",
            url: "/product-list",
            success: function (response) {
                //console.log(response);
                startAutoComplete(response);
            }
        });

        function startAutoComplete(availableTags)
        {
            $( "#search_product" ).autocomplete({
                source: availableTags
            });
        }


    </script>

    @if (session('status'))
    <script>
        swal("{{ session('status') }}");
    </script>
    @endif
    @yield('scripts')
</body>


<!-- molla/index-2.html') }}  22 Nov 2019 09:55:42 GMT -->
</html>

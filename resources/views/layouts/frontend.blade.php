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
                            <a href="" class="search-toggle" role="button" title="Search"><i class="icon-search"></i></a>
                            <form action="#" method="get">
                                <div class="header-search-wrapper">
                                    <label for="q" class="sr-only">Search</label>
                                    <input type="search" class="form-control" name="q" id="q" placeholder="Search in..." required>
                                </div><!-- End .header-search-wrapper -->
                            </form>
                        </div><!-- End .header-search -->
                        @if (Auth::guest())
                            <div class="dropdown cart-dropdown">
                                <a href="" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                    <i class="icon-shopping-cart"></i>
                                    <span class="cart-count">0</span>
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
                            <div class="dropdown cart-dropdown">
                                <a href="" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                    <i class="icon-shopping-cart"></i>
                                    @php
                                        $cartNum=DB::table('carts')
                                        ->where('user_id','=',Auth::id())
                                        ->get();
                                    @endphp
                                    <span class="cart-count">{{ $cartNum->count() }}</span>
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
                                        <a href="{{ url('cart') }}" class="btn btn-primary">View Cart</a>
                                        <a href="checkout.html') }}" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
                                    </div><!-- End .dropdown-cart-total -->
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
                                                <p><a href=""><i class="icon-user"></i><font color="black"> User</font></a></p>

                                            </li>
                                            <li>
                                                <p><a href="{{ url('cart') }}"><i class="icon-shopping-cart"></i><font color="black"> Cart <span class="badge badge-secondary" id="cartnum2">{{ $cartNum->count() }}</span> </font></a></p>
                                            </li>
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
    <!-- Main JS File -->
    <script src="{{ asset('fronttemplate/assets/js/main.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session('status'))
    <script>
        swal("{{ session('status') }}");
    </script>
    @endif
    @yield('scripts')
</body>


<!-- molla/index-2.html') }}  22 Nov 2019 09:55:42 GMT -->
</html>

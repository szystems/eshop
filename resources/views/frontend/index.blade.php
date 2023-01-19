@extends('layouts.frontend')
{{-- Trending products --}}
@section('content')
    <div class="intro-section bg-lighter pt-5 pb-6">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-slider-container slider-container-ratio slider-container-1 mb-2 mb-lg-0">
                        <div class="intro-slider intro-slider-1 owl-carousel owl-simple owl-light owl-nav-inside"
                            data-toggle="owl"
                            data-owl-options='{
                            "nav": false,
                            "responsive": {
                                "768": {
                                    "nav": true
                                }
                            }
                        }'>
                            <div class="intro-slide">
                                <figure class="slide-image">
                                    <picture>
                                        <source media="(max-width: 480px)"
                                            srcset="assets/images/slider/slide-1-480w.jpg') }}">
                                        <img src="{{ asset('fronttemplate/assets/images/slider/slide-1.jpg') }}"
                                            alt="Image Desc">
                                    </picture>
                                </figure><!-- End .slide-image -->

                                <div class="intro-content">
                                    <h3 class="intro-subtitle">Topsale Collection</h3><!-- End .h3 intro-subtitle -->
                                    <h1 class="intro-title">Living Room<br>Furniture</h1><!-- End .intro-title -->

                                    <a href="category.html" class="btn btn-outline-white">
                                        <span>SHOP NOW</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </a>
                                </div><!-- End .intro-content -->
                            </div><!-- End .intro-slide -->

                            <div class="intro-slide">
                                <figure class="slide-image">
                                    <picture>
                                        <source media="(max-width: 480px)"
                                            srcset="assets/images/slider/slide-2-480w.jpg') }}">
                                        <img src="{{ asset('fronttemplate/assets/images/slider/slide-2.jpg') }}"
                                            alt="Image Desc">
                                    </picture>
                                </figure><!-- End .slide-image -->

                                <div class="intro-content">
                                    <h3 class="intro-subtitle">News and Inspiration</h3><!-- End .h3 intro-subtitle -->
                                    <h1 class="intro-title">New Arrivals</h1><!-- End .intro-title -->

                                    <a href="category.html" class="btn btn-outline-white">
                                        <span>SHOP NOW</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </a>
                                </div><!-- End .intro-content -->
                            </div><!-- End .intro-slide -->

                            <div class="intro-slide">
                                <figure class="slide-image">
                                    <picture>
                                        <source media="(max-width: 480px)"
                                            srcset="assets/images/slider/slide-3-480w.jpg') }}">
                                        <img src="{{ asset('fronttemplate/assets/images/slider/slide-3.jpg') }}"
                                            alt="Image Desc">
                                    </picture>
                                </figure><!-- End .slide-image -->

                                <div class="intro-content">
                                    <h3 class="intro-subtitle">Outdoor Furniture</h3><!-- End .h3 intro-subtitle -->
                                    <h1 class="intro-title">Outdoor Dining <br>Furniture</h1><!-- End .intro-title -->

                                    <a href="category.html" class="btn btn-outline-white">
                                        <span>SHOP NOW</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </a>
                                </div><!-- End .intro-content -->
                            </div><!-- End .intro-slide -->
                        </div><!-- End .intro-slider owl-carousel owl-simple -->

                        <span class="slider-loader"></span><!-- End .slider-loader -->
                    </div><!-- End .intro-slider-container -->
                </div><!-- End .col-lg-8 -->
            </div><!-- End .row -->

            <div class="mb-6"></div><!-- End .mb-6 -->


        </div><!-- End .container -->
    </div><!-- End .bg-lighter -->

    <div class="mb-6"></div><!-- End .mb-6 -->

    <div class="container">
        <div class="heading heading-center mb-3">
            <h2 class="title-lg">Trendy Products</h2><!-- End .title -->

            <ul class="nav nav-pills justify-content-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="trendy-all-link" data-toggle="tab" href="#trendy-all-tab" role="tab"
                        aria-controls="trendy-all-tab" aria-selected="true">All</a>
                </li>

            </ul>
        </div><!-- End .heading -->

        <div class="tab-content tab-content-carousel">
            <div class="tab-pane p-0 fade show active" id="trendy-all-tab" role="tabpanel"
                aria-labelledby="trendy-all-link">
                <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                    data-owl-options='{
                        "nav": false,
                        "dots": true,
                        "margin": 20,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":2
                            },
                            "480": {
                                "items":2
                            },
                            "768": {
                                "items":3
                            },
                            "992": {
                                "items":4
                            },
                            "1200": {
                                "items":4,
                                "nav": true,
                                "dots": false
                            }
                        }
                    }'>
                    @foreach ($trending as $prod)
                        <div class="product product-11 text-center product_data">
                            <figure class="product-media">
                                <a href="{{ url('category/'.$prod->category->slug.'/'.$prod->slug) }}">
                                    <img src="{{ asset('assets/uploads/product/'.$prod->image) }}" alt="{{ $prod->name }}" class="product-image">
                                    <img src="{{ asset('assets/uploads/product/'.$prod->image) }}" alt="{{ $prod->name }}" class="product-image-hover">
                                    @if ($prod->trending == "1")
                                        <span class="product-label label-sale">{{ $prod->trending == '1'? 'Trending':''}}</span>
                                    @endif
                                    @if ($prod->discount == "1")
                                        <span class="product-label label-top">{{ $prod->discount == '1'? '% Off':''}}</span>
                                    @endif
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon addToWishlist btn-wishlist"><span>add to wishlist</span></a>
                                </div><!-- End .product-action-vertical -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <input type="hidden" value="{{ $prod->id }}" class="prod_id">
                                <input type="hidden" value="1" class="qty-input">
                                <h3 class="product-title"><a href="{{ url('category/'.$prod->category->slug.'/'.$prod->slug) }}">{{ substr($prod->name, 0, 25) }}...</a></h3>
                                <!-- End .product-title -->
                                <div class="product-price">
                                    @if ($prod->discount == "1")
                                        <span class="new-price">${{ number_format($prod->selling_price,2, '.', ',') }}</span>
                                        <span class="old-price"><strike>${{ number_format($prod->original_price,2, '.', ',') }}</strike></span>
                                    @else
                                        <span class="new-price">${{ number_format($prod->original_price,2, '.', ',') }}</span>
                                    @endif

                                </div><!-- End .product-price -->
                                @if($prod->qty > 0)
                                    <span class="badge badge-success">In stock</span>
                                @else
                                    <span class="badge badge-danger">out of stock</span>
                                @endif
                                {{-- <div class="product-price">
                                    <button href="#" class="btn-product"><i class="icon-heart-o"></i><span>Add To Wishlist</span></button>
                                </div><!-- End .product-price --> --}}
                                    <button class="btn addToWishlist btn-primary-2">+ Add<i class="icon-heart-o"></i></button>
                            </div><!-- End .product-body -->
                            @if ($prod->qty > 0)
                                <div class="product-action">
                                    <button href="#" class="btn-product btn-cart addToCartBtn"><span>add to cart</span></button>
                                </div><!-- End .product-action -->
                            @else
                                <div class="product-action">
                                    <a href="{{ url('category/'.$prod->category->slug.'/'.$prod->slug) }}" class="btn-product"><i class="icon-search"></i><span> View Details...</span></a>
                                </div><!-- End .product-action -->
                            @endif

                        </div><!-- End .product -->
                    @endforeach

                </div><!-- End .owl-carousel -->
            </div><!-- .End .tab-pane -->
        </div><!-- End .tab-content -->
    </div><!-- End .container -->

    {{-- popular Categories --}}
    <div class="container">
        <div class="heading heading-center mb-3">
            <h2 class="title-lg">Popular Category</h2><!-- End .title -->

            <ul class="nav nav-pills justify-content-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="trendy-all-link" data-toggle="tab" href="#trendy-all-tab" role="tab"
                        aria-controls="trendy-all-tab" aria-selected="true">All</a>
                </li>

            </ul>
        </div><!-- End .heading -->

        <div class="tab-content tab-content-carousel">
            <div class="tab-pane p-0 fade show active" id="trendy-all-tab" role="tabpanel"
                aria-labelledby="trendy-all-link">
                <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                    data-owl-options='{
                        "nav": false,
                        "dots": true,
                        "margin": 20,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":2
                            },
                            "480": {
                                "items":2
                            },
                            "768": {
                                "items":3
                            },
                            "992": {
                                "items":4
                            },
                            "1200": {
                                "items":4,
                                "nav": true,
                                "dots": false
                            }
                        }
                    }'>
                    @foreach ($popular as $catpop)
                        <div class="product product-11 text-center">
                            <figure class="product-media">
                                @if ($catpop->popular == '1')
                                <span class="product-label label-new"><font color="white">Popular</font></span>
                                @endif
                                <a href="{{ url('view-category/'.$catpop->slug) }}">
                                    <img src="{{ asset('assets/uploads/category/'.$catpop->image) }}" alt="{{ $catpop->name }}"
                                        class="product-image">
                                    <img src="{{ asset('assets/uploads/category/'.$catpop->image) }}" alt="{{ $catpop->name }}"
                                        class="product-image-hover">
                                </a>

                                {{-- <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist"><span>add to wishlist</span></a>
                                </div><!-- End .product-action-vertical --> --}}
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <h3 class="product-title"><a href="{{ url('view-category/'.$catpop->slug) }}">{{ $catpop->name }}</a></h3>
                                <!-- End .product-title -->
                                <div class="product-price">
                                    <p>{{ $catpop->description }}</p>
                                </div><!-- End .product-price -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    @endforeach

                </div><!-- End .owl-carousel -->
            </div><!-- .End .tab-pane -->
        </div><!-- End .tab-content -->
    </div><!-- End .container -->


    <div class="container">
        <div class="heading heading-center mb-3">
            <h2 class="title-lg">Discounts</h2><!-- End .title -->

            <ul class="nav nav-pills justify-content-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="trendy-all-link" data-toggle="tab" href="#trendy-all-tab" role="tab"
                        aria-controls="trendy-all-tab" aria-selected="true">All</a>
                </li>

            </ul>
        </div><!-- End .heading -->

        <div class="tab-content tab-content-carousel">
            <div class="tab-pane p-0 fade show active" id="trendy-all-tab" role="tabpanel"
                aria-labelledby="trendy-all-link">
                <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                    data-owl-options='{
                        "nav": false,
                        "dots": true,
                        "margin": 20,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":2
                            },
                            "480": {
                                "items":2
                            },
                            "768": {
                                "items":3
                            },
                            "992": {
                                "items":4
                            },
                            "1200": {
                                "items":4,
                                "nav": true,
                                "dots": false
                            }
                        }
                    }'>
                    @foreach ($discount as $prod)
                        <div class="product product-11 text-center product_data">
                            <figure class="product-media">
                                <a href="{{ url('category/'.$prod->category->slug.'/'.$prod->slug) }}">
                                    <img src="{{ asset('assets/uploads/product/'.$prod->image) }}" alt="{{ $prod->name }}" class="product-image">
                                    <img src="{{ asset('assets/uploads/product/'.$prod->image) }}" alt="{{ $prod->name }}" class="product-image-hover">
                                    @if ($prod->trending == "1")
                                        <span class="product-label label-sale">{{ $prod->trending == '1'? 'Trending':''}}</span>
                                    @endif
                                    @if ($prod->discount == "1")
                                        <span class="product-label label-top">{{ $prod->discount == '1'? '% Off':''}}</span>
                                    @endif
                                </a>

                                {{-- <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist"><span>add to wishlist</span></a>
                                </div><!-- End .product-action-vertical --> --}}
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <input type="hidden" value="{{ $prod->id }}" class="prod_id">
                                <input type="hidden" value="1" class="qty-input">
                                <h3 class="product-title"><a href="{{ url('category/'.$prod->category->slug.'/'.$prod->slug) }}">{{ substr($prod->name, 0, 25) }}...</a></h3>
                                <!-- End .product-title -->
                                <div class="product-price">
                                    @if ($prod->discount == "1")
                                        <span class="new-price">${{ number_format($prod->selling_price,2, '.', ',') }}</span>
                                        <span class="old-price"><strike>${{ number_format($prod->original_price,2, '.', ',') }}</strike></span>
                                    @else
                                        <span class="new-price">${{ number_format($prod->original_price,2, '.', ',') }}</span>
                                    @endif

                                </div><!-- End .product-price -->
                                @if($prod->qty > 0)
                                    <span class="badge badge-success">In stock</span>
                                @else
                                    <span class="badge badge-danger">out of stock</span>
                                @endif
                            </div><!-- End .product-body -->
                            @if ($prod->qty > 0)
                                <div class="product-action">
                                    <button href="#" class="btn-product btn-cart addToCartBtn"><span>add to cart</span></button>
                                </div><!-- End .product-action -->
                            @else
                                <div class="product-action">
                                    <a href="{{ url('category/'.$prod->category->slug.'/'.$prod->slug) }}" class="btn-product"><i class="icon-search"></i><span> View Details...</span></a>
                                </div><!-- End .product-action -->
                            @endif

                        </div><!-- End .product -->
                    @endforeach

                </div><!-- End .owl-carousel -->
            </div><!-- .End .tab-pane -->
        </div><!-- End .tab-content -->
    </div><!-- End .container -->


@endsection

@extends('layouts.frontend')
{{-- Trending products --}}
@section('content')
    <div class="page-header text-center" style="background-image: url({{asset('fronttemplate/assets/images/page-header-bg.jpg')}})">
        <div class="container">
            <h1 class="page-title">Category<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->

    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('category') }}">Category</a></li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    {{-- Categories --}}

    <div class="mb-6"></div><!-- End .mb-6 -->

    <div class="container">
        <div class="heading heading-center mb-3">
            <h2 class="title-lg">Category</h2><!-- End .title -->

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
                    @foreach ($categories as $cat)
                        <div class="product product-11 text-center">
                            <figure class="product-media">
                                @if ($cat->popular == '1')
                                <span class="product-label label-new"><font color="white">Popular</font></span>
                                @endif

                                <a href="{{ url('view-category/'.$cat->slug) }}">
                                    <img src="{{ asset('assets/uploads/category/'.$cat->image) }}" alt="{{ $cat->name }}"
                                        class="product-image">
                                    <img src="{{ asset('assets/uploads/category/'.$cat->image) }}" alt="{{ $cat->name }}"
                                        class="product-image-hover">
                                </a>

                                {{-- <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist"><span>add to wishlist</span></a>
                                </div><!-- End .product-action-vertical --> --}}
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <h3 class="product-title"><a href="{{ url('view-category/'.$cat->slug) }}">{{ $cat->name }}</a></h3>
                                <!-- End .product-title -->
                                <div class="product-price">
                                    <p>{{ $cat->description }}</p>
                                </div><!-- End .product-price -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    @endforeach

                </div><!-- End .owl-carousel -->
            </div><!-- .End .tab-pane -->
        </div><!-- End .tab-content -->
    </div><!-- End .container -->
@endsection

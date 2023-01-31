@extends('layouts.frontend')
{{-- Trending products --}}
@section('content')
    <div class="page-header text-center" style="background-image: url({{asset('fronttemplate/assets/images/page-header-bg.jpg')}})">
        <div class="container">
            <h1 class="page-title">{{ $category->name }}<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->

    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('category') }}">{{ $category->name }}</a></li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    {{-- Categories --}}

    <div class="mb-6"></div><!-- End .mb-6 -->

    {{-- Products --}}

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="products mb-3">
                        <div class="row justify-content-center">

                            @foreach ($products as $prod)
                                <div class="col-4 col-md-4 col-lg-4 product_data">
                                    <div class="product product-7 text-center">
                                        <figure class="product-media">
                                            @if ($prod->trending == "1")
                                                <span class="product-label label-sale">{{ $prod->trending == '1'? 'Trending':''}}</span>
                                            @endif
                                            @if ($prod->discount == "1")
                                                <span class="product-label label-top">{{ $prod->discount == '1'? '% Off':''}}</span>
                                            @endif
                                            {{-- <span class="product-label label-new">New</span> --}}
                                            <a href="{{ url('category/'.$category->slug.'/'.$prod->slug) }}">
                                                <img src="{{ asset('assets/uploads/product/'.$prod->image) }}" alt="Product image" class="product-image">
                                            </a>

                                            {{-- <div class="product-action-vertical">
                                                <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                                <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                                <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                                            </div><!-- End .product-action-vertical --> --}}
                                            @if ($prod->qty > 0)
                                                <div class="product-action">
                                                    <button href="#" class="btn-product btn-cart addToCartBtn"><span>add to cart</span></button>
                                                </div><!-- End .product-action -->
                                            @else
                                                <div class="product-action">
                                                    <a href="{{ url('category/'.$prod->category->slug.'/'.$prod->slug) }}" class="btn-product"><i class="icon-search"></i><span> View Details...</span></a>
                                                </div><!-- End .product-action -->
                                            @endif
                                            <div class="product-action-vertical">
                                                <a href="#" class="btn-product-icon addToWishlist btn-wishlist"><span>add to wishlist</span></a>
                                            </div><!-- End .product-action-vertical -->
                                        </figure><!-- End .product-media -->

                                        <div class="product-body">
                                            <div class="product-cat">
                                                <input type="hidden" value="{{ $prod->id }}" class="prod_id">
                                                <input type="hidden" value="1" class="qty-input">
                                                @php
                                                    $product_ratings=DB::table('ratings')
                                                    ->where('prod_id','=',$prod->id)
                                                    ->get();
                                                    $ratingsum = 0;
                                                    foreach ($product_ratings as $rating) {
                                                        $ratingsum = $ratingsum + $rating->stars_rated;
                                                    }

                                                    if ($product_ratings->count() > 0) {
                                                        $rating_value = $ratingsum/$product_ratings->count();
                                                    } else {
                                                        $rating_value = 0;
                                                    }
                                                    $rating_stars = number_format($rating_value)*20;
                                                @endphp
                                                <div class="ratings-container">
                                                    <div class="ratings">
                                                        <div class="ratings-val" style="width: {{ $rating_stars }}%;"></div><!-- End .ratings-val -->
                                                    </div><!-- End .ratings -->
                                                    <span class="ratings-text">
                                                        <a href="{{ url('category/'.$prod->category->slug.'/'.$prod->slug) }}">
                                                            ( {{ $product_ratings->count() }} Reviews )
                                                        </a>
                                                    </span>
                                                </div><!-- End .rating-container -->
                                                <a href="{{ url('view-category/'.$category->slug) }}">{{ $category->name }}</a>
                                            </div><!-- End .product-cat -->
                                            <h3 class="product-title"><a href="{{ url('category/'.$category->slug.'/'.$prod->slug) }}">{{ substr($prod->name, 0, 30) }}...</a></h3><!-- End .product-title -->
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
                                            <button class="btn addToWishlist btn-primary-2">+ Add<i class="icon-heart-o"></i></button>
                                            {{-- <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                                                </div><!-- End .ratings -->
                                                <span class="ratings-text">( 2 Reviews )</span>
                                            </div><!-- End .rating-container -->

                                            <div class="product-nav product-nav-thumbs">
                                                <a href="#" class="active">
                                                    <img src="assets/images/products/product-4-thumb.jpg" alt="product desc">
                                                </a>
                                                <a href="#">
                                                    <img src="assets/images/products/product-4-2-thumb.jpg" alt="product desc">
                                                </a>

                                                <a href="#">
                                                    <img src="assets/images/products/product-4-3-thumb.jpg" alt="product desc">
                                                </a>
                                            </div><!-- End .product-nav --> --}}
                                        </div><!-- End .product-body -->
                                    </div><!-- End .product -->
                                </div><!-- End .col-sm-6 col-lg-4 -->
                            @endforeach

                        </div><!-- End .row -->
                    </div><!-- End .products -->

                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link page-link-prev" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                    <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                                </a>
                            </li>
                            <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item-total">of 6</li>
                            <li class="page-item">
                                <a class="page-link page-link-next" href="#" aria-label="Next">
                                    Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div><!-- End .col-lg-9 -->

            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
@endsection

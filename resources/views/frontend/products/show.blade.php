@extends('layouts.frontend')
{{-- Trending products --}}
@section('content')
    <div class="page-header text-center" style="background-image: url({{asset('fronttemplate/assets/images/page-header-bg.jpg')}}">
        <div class="container">
            <h1 class="page-title">{{ $product->name }}<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->

    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('category') }}">{{ $product->category->name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    {{-- Categories --}}

    <div class="mb-6"></div><!-- End .mb-6 -->

    {{-- Product details --}}

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="product-details-top">
                        <div class="row">
                            <div class="col-md-6 col-lg-7">
                                <div class="product-gallery">
                                    <figure class="product-main-image">
                                        @if ($product->trending == "1")
                                            <span class="product-label label-sale">{{ $product->trending == '1'? 'Trending':''}}</span>
                                        @endif
                                        @if ($product->discount == "1")
                                            <span class="product-label label-top">{{ $product->discount == '1'? '% Off':''}}</span>
                                        @endif

                                        <img id="product-zoom" src="{{ asset('assets/uploads/product/'.$product->image) }}" data-zoom-image="{{ asset('assets/uploads/product/'.$product->image) }}" alt="{{ $product->name }}">

                                        <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                            <i class="icon-arrows"></i>
                                        </a>
                                    </figure><!-- End .product-main-image -->

                                    <div id="product-zoom-gallery" class="product-image-gallery max-col-6">
                                        <a class="product-gallery-item" href="#" data-image="{{ asset('assets/uploads/product/'.$product->image) }}" data-zoom-image="{{ asset('assets/uploads/product/'.$product->image) }}">
                                            <img src="{{ asset('assets/uploads/product/'.$product->image) }}" alt="product side">
                                        </a>

                                    </div><!-- End .product-image-gallery -->
                                </div><!-- End .product-gallery -->
                            </div><!-- End .col-lg-7 -->

                            <div class="col-md-6 col-lg-5">
                                <div class="product-details product_data">
                                    <h1 class="product-title">{{ $product->name }}</h1>
                                    <h5>
                                        @if ($product->trending == '1')
                                            <span class="badge badge-danger">Trending</span>
                                        @endif
                                        @if($product->qty > 0)
                                            <span class="badge badge-success">In stock</span>
                                        @else
                                            <span class="badge badge-danger">out of stock</span>
                                        @endif
                                    </h5>
                                    <!-- End .product-title -->

                                    {{-- <div class="ratings-container">
                                        <div class="ratings">
                                            <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                        </div><!-- End .ratings -->
                                        <a class="ratings-text" href="#product-accordion" id="review-link">( 2 Reviews )</a>
                                    </div><!-- End .rating-container --> --}}

                                    <div class="product-price">
                                        @if ($product->discount == "1")
                                        <span class="new-price">${{ number_format($product->selling_price,2, '.', ',') }}</span>
                                        <span class="old-price">${{ number_format($product->original_price,2, '.', ',') }}</span>
                                        @else
                                            <span class="new-price">${{ number_format($product->original_price,2, '.', ',') }}</span>
                                        @endif

                                    </div><!-- End .product-price -->

                                    <div class="product-content">
                                        <p>{{ $product->small_description }}</p>
                                    </div><!-- End .product-content -->

                                    {{-- <div class="details-filter-row details-row-size">
                                        <label>Color:</label>

                                        <div class="product-nav product-nav-thumbs">
                                            <a href="#" class="active">
                                                <img src="assets/images/products/single/fullwidth/1-thumb.jpg" alt="product desc">
                                            </a>
                                            <a href="#">
                                                <img src="assets/images/products/single/fullwidth/2-thumb.jpg" alt="product desc">
                                            </a>
                                            <a href="#">
                                                <img src="assets/images/products/single/fullwidth/3-thumb.jpg" alt="product desc">
                                            </a>
                                            <a href="#">
                                                <img src="assets/images/products/single/fullwidth/4-thumb.jpg" alt="product desc">
                                            </a>
                                        </div><!-- End .product-nav -->
                                    </div><!-- End .details-filter-row --> --}}

                                    {{-- <div class="details-filter-row details-row-size">
                                        <label for="size">Size:</label>
                                        <div class="select-custom">
                                            <select name="size" id="size" class="form-control">
                                                <option value="#" selected="selected">Select a size</option>
                                                <option value="s">Small</option>
                                                <option value="m">Medium</option>
                                                <option value="l">Large</option>
                                                <option value="xl">Extra Large</option>
                                            </select>
                                        </div><!-- End .select-custom -->
                                    </div><!-- End .details-filter-row --> --}}
                                    @if($product->qty > 0)
                                        <div class="details-filter-row details-row-size">
                                            <label for="qty">Qty:</label>
                                            <div class="product-details-quantity">
                                                <input type="hidden" value="{{ $product->id }}" class="prod_id">
                                                <input type="number" name="quantity" class="form-control qty-input" value="1" min="1" max="10" step="1" data-decimals="0" required>
                                            </div><!-- End .product-details-quantity -->
                                        </div><!-- End .details-filter-row -->
                                    @endif

                                    <div class="product-details-action">

                                        @if($product->qty > 0)
                                            <button type="button" class="btn-product btn-cart addToCartBtn"><span>add to cart</span></button>
                                        @endif

                                        <div class="details-action-wrapper">

                                            <a class="btn-product btn-wishlist" title="Wishlist"><span>Add to Wishlist</span></a>
                                            {{-- <a href="#" class="btn-product btn-compare" title="Compare"><span>Add to Compare</span></a> --}}
                                        </div><!-- End .details-action-wrapper -->
                                    </div><!-- End .product-details-action -->

                                    <div class="product-details-footer">
                                        <div class="product-cat">
                                            <span>Category:</span>
                                            <a href="#">{{ $product->category->name }}</a>
                                            {{-- <a href="#">Dresses</a>,
                                            <a href="#">Yellow</a> --}}
                                        </div><!-- End .product-cat -->

                                        <div class="social-icons social-icons-sm">
                                            <span class="social-label">Share:</span>
                                            <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                            <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                            <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                            <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                        </div>
                                    </div><!-- End .product-details-footer -->

                                    <div class="accordion accordion-plus product-details-accordion" id="product-accordion">
                                        <div class="card card-box card-sm">
                                            <div class="card-header" id="product-desc-heading">
                                                <h2 class="card-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" href="#product-accordion-desc" aria-expanded="false" aria-controls="product-accordion-desc">
                                                        Description
                                                    </a>
                                                </h2>
                                            </div><!-- End .card-header -->
                                            <div id="product-accordion-desc" class="collapse" aria-labelledby="product-desc-heading" data-parent="#product-accordion">
                                                <div class="card-body">
                                                    <div class="product-desc-content">
                                                        <p>{{ $product->description }}</p>
                                                    </div><!-- End .product-desc-content -->
                                                </div><!-- End .card-body -->
                                            </div><!-- End .collapse -->
                                        </div><!-- End .card -->

                                        <div class="card card-box card-sm">
                                            <div class="card-header" id="product-info-heading">
                                                <h2 class="card-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" href="#product-accordion-info" aria-expanded="false" aria-controls="product-accordion-info">
                                                        Additional Information
                                                    </a>
                                                </h2>
                                            </div><!-- End .card-header -->
                                            <div id="product-accordion-info" class="collapse" aria-labelledby="product-info-heading" data-parent="#product-accordion">
                                                <div class="card-body">
                                                    <div class="product-desc-content">
                                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. </p>

                                                        <h3>Fabric & care</h3>
                                                        <ul>
                                                            <li>100% Polyester</li>
                                                            <li>Do not iron</li>
                                                            <li>Do not wash</li>
                                                            <li>Do not bleach</li>
                                                            <li>Do not tumble dry</li>
                                                            <li>Professional dry clean only</li>
                                                        </ul>

                                                        <h3>Size</h3>
                                                        <p>S, M, L, XL</p>
                                                    </div><!-- End .product-desc-content -->
                                                </div><!-- End .card-body -->
                                            </div><!-- End .collapse -->
                                        </div><!-- End .card -->

                                        <div class="card card-box card-sm">
                                            <div class="card-header" id="product-shipping-heading">
                                                <h2 class="card-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" href="#product-accordion-shipping" aria-expanded="false" aria-controls="product-accordion-shipping">
                                                        Shipping & Returns
                                                    </a>
                                                </h2>
                                            </div><!-- End .card-header -->
                                            <div id="product-accordion-shipping" class="collapse" aria-labelledby="product-shipping-heading" data-parent="#product-accordion">
                                                <div class="card-body">
                                                    <div class="product-desc-content">
                                                        <p>We deliver to over 100 countries around the world. For full details of the delivery options we offer, please view our <a href="#">Delivery information</a><br>
                                                        We hope you’ll love every purchase, but if you ever need to return an item you can do so within a month of receipt. For full details of how to make a return, please view our <a href="#">Returns information</a></p>
                                                    </div><!-- End .product-desc-content -->
                                                </div><!-- End .card-body -->
                                            </div><!-- End .collapse -->
                                        </div><!-- End .card -->

                                        {{-- <div class="card card-box card-sm">
                                            <div class="card-header" id="product-review-heading">
                                                <h2 class="card-title">
                                                    <a role="button" data-toggle="collapse" href="#product-accordion-review" aria-expanded="true" aria-controls="product-accordion-review">
                                                        Reviews (2)
                                                    </a>
                                                </h2>
                                            </div><!-- End .card-header -->
                                            <div id="product-accordion-review" class="collapse show" aria-labelledby="product-review-heading" data-parent="#product-accordion">
                                                <div class="card-body">
                                                    <div class="reviews">
                                                        <div class="review">
                                                            <div class="row no-gutters">
                                                                <div class="col-auto">
                                                                    <h4><a href="#">Samanta J.</a></h4>
                                                                    <div class="ratings-container">
                                                                        <div class="ratings">
                                                                            <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                                                        </div><!-- End .ratings -->
                                                                    </div><!-- End .rating-container -->
                                                                    <span class="review-date">6 days ago</span>
                                                                </div><!-- End .col -->
                                                                <div class="col">
                                                                    <h4>Good, perfect size</h4>

                                                                    <div class="review-content">
                                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus cum dolores assumenda asperiores facilis porro reprehenderit animi culpa atque blanditiis commodi perspiciatis doloremque, possimus, explicabo, autem fugit beatae quae voluptas!</p>
                                                                    </div><!-- End .review-content -->

                                                                    <div class="review-action">
                                                                        <a href="#"><i class="icon-thumbs-up"></i>Helpful (2)</a>
                                                                        <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                                                    </div><!-- End .review-action -->
                                                                </div><!-- End .col-auto -->
                                                            </div><!-- End .row -->
                                                        </div><!-- End .review -->

                                                        <div class="review">
                                                            <div class="row no-gutters">
                                                                <div class="col-auto">
                                                                    <h4><a href="#">John Doe</a></h4>
                                                                    <div class="ratings-container">
                                                                        <div class="ratings">
                                                                            <div class="ratings-val" style="width: 100%;"></div><!-- End .ratings-val -->
                                                                        </div><!-- End .ratings -->
                                                                    </div><!-- End .rating-container -->
                                                                    <span class="review-date">5 days ago</span>
                                                                </div><!-- End .col -->
                                                                <div class="col">
                                                                    <h4>Very good</h4>

                                                                    <div class="review-content">
                                                                        <p>Sed, molestias, tempore? Ex dolor esse iure hic veniam laborum blanditiis laudantium iste amet. Cum non voluptate eos enim, ab cumque nam, modi, quas iure illum repellendus, blanditiis perspiciatis beatae!</p>
                                                                    </div><!-- End .review-content -->

                                                                    <div class="review-action">
                                                                        <a href="#"><i class="icon-thumbs-up"></i>Helpful (0)</a>
                                                                        <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                                                    </div><!-- End .review-action -->
                                                                </div><!-- End .col-auto -->
                                                            </div><!-- End .row -->
                                                        </div><!-- End .review -->
                                                    </div><!-- End .reviews -->
                                                </div><!-- End .card-body -->
                                            </div><!-- End .collapse -->
                                        </div><!-- End .card --> --}}
                                    </div><!-- End .accordion -->
                                </div><!-- End .product-details -->
                            </div><!-- End .col-lg-5 -->
                        </div><!-- End .row -->
                    </div><!-- End .product-details-top -->
                </div><!-- End .col-xl-10 -->


            </div><!-- End .row -->

        </div><!-- End .container-fluid -->
    </div><!-- End .page-content -->


@endsection


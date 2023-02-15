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
                                    @php
                                        $rating = number_format($rating_value)*20;
                                    @endphp
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: {{ $rating }}%;"></div>
                                    </div><!-- End .ratings -->
                                        <!-- Button trigger modal -->
                                        <a type="button" class="btn btn-link" data-toggle="modal" data-target="#exampleModal">
                                            <p>({{ $ratings->count() }}) <u>Rate & review Product </u></p><!-- End .ratings-val -->
                                        </a>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Rate {{ $product->name }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ url('/add-rating') }}" method="POST">
                                                @csrf
                                                <div class="modal-body">

                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                                    <div align="center">
                                                        <p><u>Your Rating: </u></p>
                                                        {{-- <input type="radio" value="1" name="product_rating" checked id="rating1">
                                                        <label for="rating1" class="fa fa-star"></label>
                                                        <input type="radio" value="2" name="product_rating" id="rating2">
                                                        <label for="rating2" class="fa fa-star"></label>
                                                        <input type="radio" value="3" name="product_rating" id="rating3">
                                                        <label for="rating3" class="fa fa-star"></label>
                                                        <input type="radio" value="4" name="product_rating" id="rating4">
                                                        <label for="rating4" class="fa fa-star"></label>
                                                        <input type="radio" value="5" name="product_rating" id="rating5">
                                                        <label for="rating5" class="fa fa-star"></label> --}}

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="product_rating" id="rating1" value="1" @if($user_rating == 1) checked @endif>
                                                            <label class="form-check-label" for="rating1">
                                                                <div class="ratings">
                                                                    <div class="ratings-val" style="width: 20%;"></div>
                                                                </div><!-- End .ratings -->
                                                            </label>
                                                        </div>
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="product_rating" id="rating2" value="2" @if($user_rating == 2) checked @endif>
                                                            <label class="form-check-label" for="rating2">
                                                                <div class="ratings">
                                                                    <div class="ratings-val" style="width: 40%;"></div>
                                                                </div><!-- End .ratings -->
                                                            </label>
                                                        </div>
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="product_rating" id="rating3" value="3" @if($user_rating == 3) checked @endif>
                                                            <label class="form-check-label" for="rating3">
                                                                <div class="ratings">
                                                                    <div class="ratings-val" style="width: 60%;"></div>
                                                                </div><!-- End .ratings -->
                                                            </label>
                                                        </div>
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="product_rating" id="rating4" value="4" @if($user_rating == 4) checked @endif>
                                                            <label class="form-check-label" for="rating4">
                                                                <div class="ratings">
                                                                    <div class="ratings-val" style="width: 80%;"></div>
                                                                </div><!-- End .ratings -->
                                                            </label>
                                                        </div>
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="product_rating" id="rating5" value="5" @if($user_rating == 5) checked @endif>
                                                            <label class="form-check-label" for="rating5">
                                                                <div class="ratings">
                                                                    <div class="ratings-val" style="width: 100%;"></div>
                                                                </div><!-- End .ratings -->
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 mb-3" align="left">
                                                            <label for="">Your Review:</label>
                                                            <textarea name="review" rows="3" class="form-control border px-2" placeholder="Write a review...">@if($user_review != null) {{ $user_review }} @endif</textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-secondary">Rate</button>
                                                </div>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                    <!-- end Modal -->
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
                                        <span class="new-price">{{ $config->currency_simbol }}{{ number_format($product->selling_price,2, '.', ',') }}</span>
                                        <span class="old-price">{{ $config->currency_simbol }}{{ number_format($product->original_price,2, '.', ',') }}</span>
                                        @else
                                            <span class="new-price">{{ $config->currency_simbol }}{{ number_format($product->original_price,2, '.', ',') }}</span>
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
                                            @if (Auth::guest())
                                                <button href="#signin-modal" data-toggle="modal" type="button" class="btn-product btn-cart"><span>add to cart</span></button>
                                            @else
                                                <button type="button" class="btn-product btn-cart addToCartBtn"><span>add to cart</span></button>
                                            @endif

                                        @endif
                                        <div class="details-action-wrapper">
                                            @if (Auth::guest())
                                                <a href="#signin-modal" data-toggle="modal" class="btn-product btn-wishlist addToWishlist" title="Wishlist"><span>Add to Wishlist</span></a>
                                            @else
                                                <a href="#" class="btn-product btn-wishlist addToWishlist" title="Wishlist"><span>Add to Wishlist</span></a>
                                            @endif

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

                                        <div class="card card-box card-sm">
                                            <div class="card-header" id="product-review-heading">
                                                <h2 class="card-title">
                                                    <a role="button" data-toggle="collapse" href="#product-accordion-review" aria-expanded="true" aria-controls="product-accordion-review">
                                                        Reviews ({{ $ratings->count() }})
                                                    </a>
                                                </h2>
                                            </div><!-- End .card-header -->
                                            <div id="product-accordion-review" class="collapse show" aria-labelledby="product-review-heading" data-parent="#product-accordion">
                                                <div class="card-body">
                                                    <div class="reviews">
                                                        @foreach ($ratings as $review)


                                                            <div class="review">
                                                                <div class="row no-gutters">
                                                                    <div class="col-auto">
                                                                        <h4><a href="#">{{ $review->user->name }}</a></h4>
                                                                        <div class="ratings-container">
                                                                            @php
                                                                                //stars rated for user
                                                                                $user_rating = number_format($review->stars_rated)*20;
                                                                                //time lapsed between today and coment
                                                                                $strTimeAgo = "";
                                                                                if(!empty($review->updated_at)) {
                                                                                        $strTimeAgo = $review->updated_at;
                                                                                }
                                                                                    $timestamp = strtotime($strTimeAgo);

                                                                                    $strTime = array("segundo", "minuto", "hora", "dia", "mes", "año");
                                                                                    $length = array("60","60","24","30","12","10");

                                                                                    $currentTime = time();
                                                                                    if($currentTime >= $timestamp) {
                                                                                        $diff     = time()- $timestamp;
                                                                                            for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
                                                                                            $diff = $diff / $length[$i];
                                                                                        }

                                                                                        $diff = round($diff);
                                                                                        $reviewtimeago =  "Hace ". $diff." ". $strTime[$i]."(s)";
                                                                                    }
                                                                            @endphp
                                                                            <div class="ratings">
                                                                                <div class="ratings-val" style="width: {{ $user_rating }}%;"></div><!-- End .ratings-val -->
                                                                            </div><!-- End .ratings -->
                                                                        </div><!-- End .rating-container -->
                                                                        <span class="review-date">{{ $reviewtimeago }}</span>
                                                                    </div><!-- End .col -->
                                                                    <div class="col">
                                                                        {{-- <h4>Good, perfect size</h4> --}}

                                                                        <div class="review-content">
                                                                            <p>{{ $review->review }}</p>
                                                                        </div><!-- End .review-content -->

                                                                        @if(Auth::id() == $review->user_id)
                                                                        <a type="button" class="btn btn-link" data-toggle="modal" data-target="#exampleModal">
                                                                            <p><u>Edit Rate & review Product </u></p><!-- End .ratings-val -->
                                                                        </a>
                                                                        @endif

                                                                        {{-- <div class="review-action">
                                                                            <a href="#"><i class="icon-thumbs-up"></i>Helpful (2)</a>
                                                                            <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                                                        </div><!-- End .review-action --> --}}
                                                                    </div><!-- End .col-auto -->
                                                                </div><!-- End .row -->
                                                            </div><!-- End .review -->

                                                        @endforeach

                                                        {{-- <div class="review">
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
                                                        </div><!-- End .review --> --}}
                                                    </div><!-- End .reviews -->
                                                </div><!-- End .card-body -->
                                            </div><!-- End .collapse -->
                                        </div><!-- End .card -->
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


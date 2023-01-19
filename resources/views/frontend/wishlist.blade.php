@extends('layouts.frontend')
{{-- Trending products --}}
@section('content')
    <div class="page-header text-center" style="background-image: url({{ asset('fronttemplate/assets/images/page-header-bg.jpg') }})">
        <div class="container">
            <h1 class="page-title">Wishlist<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('wishlist') }}">Wishlist</a></li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">

            <table class="table table-wishlist table-mobile">
                @if ($wishlist->count() > 0)
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Stock Status</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($wishlist as $prod)
                            @php
                                if ($prod->discount == "1") {
                                    $price = $prod->selling_price;
                                }else {
                                    $price = $prod->original_price;
                                }
                            @endphp
                            <tr class="product_data">
                                <td class="product-col">
                                    <div class="product">
                                        <figure class="product-media">
                                            <a href="{{ url('category/'.$prod->CatSlug.'/'.$prod->ProdSlug) }}">
                                                <img src="{{ asset('assets/uploads/product/'.$prod->image) }}" alt="{{ $prod->Product }}">
                                            </a>
                                        </figure>

                                        <h3 class="product-title">
                                            <a href="{{ url('category/'.$prod->CatSlug.'/'.$prod->ProdSlug) }}">{{ $prod->Product }}</a>
                                        </h3><!-- End .product-title -->
                                    </div><!-- End .product -->
                                </td>
                                @if ($prod->discount == "1")
                                    <td class="price-col">
                                        <font color="ef837b">{{ number_format($prod->selling_price,2, '.', ',') }}</font>
                                        <font color="cccccc"><strike>{{ number_format($prod->original_price,2, '.', ',') }}</strike></font>
                                    </td>
                                @else
                                    <td class="price-col"><font color="ef837b">{{ number_format($prod->original_price,2, '.', ',') }}</font></td>
                                @endif
                                @if ($prod->qty == 0)
                                    <td class="stock-col"><span class="out-of-stock">Out of stock</span></td>
                                @else
                                    <td class="stock-col">
                                        <input type="number" name="quantity" class="form-control qty-input" value="1" min="1" max="10" step="1" data-decimals="0" required>
                                        <span class="in-stock">In stock:</span> {{ $prod->qty }}
                                    </td>
                                @endif
                                @if ($prod->qty == 0)
                                    <td class="action-col">
                                        <button disabled class="btn btn-block btn-outline-primary-2"><i class="icon-cart-plus"></i>Add to Cart</button>
                                    </td>
                                @else
                                    <td class="action-col" align="center">
                                        <input type="hidden" class="prod_id" value="{{ $prod->ProdID }}">
                                        {{-- <input type="hidden" value="1" class="qty-input"> --}}
                                        <button class="btn  addToCartBtn btn-outline-primary-2"><i class="icon-cart-plus"></i>Add to Cart</button>
                                    </td>
                                @endif
                                <td class="remove-col remove-wishlist-item"><button class="btn-remove"><i class="icon-close"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                @else
                    <h3>Wishlist is empty</h3>
                    <a href="{{ url('category') }}" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                @endif

            </table><!-- End .table table-wishlist -->
            <div class="wishlist-share">
                <div class="social-icons social-icons-sm mb-2">
                    <label class="social-label">Share on:</label>
                    <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                    <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                    <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                    <a href="#" class="social-icon" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                    <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                </div><!-- End .soial-icons -->
            </div><!-- End .wishlist-share -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
@endsection


@extends('layouts.admin')

@section('content')
    <div class="row">

        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">sell</i>
                    </div>
                    <div class="text-center pt-1">
                        {{-- <p class="text-sm mb-0 text-capitalize">Today's Money</p> --}}
                        <h4 class="mb-0">Products</h4>
                    </div>
                    <hr class="dark horizontal my-0">
                </div>
                <div class="card-body p-3 pt-2">
                    <h4><u>Show Product</u></h4>
                    <div>
                        <a href="{{ url('edit-product/'.$product->id) }}" type="button" class="btn btn-warning"><i class="material-icons">edit</i></a>
                        <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $product->id }}">
                            <i class="material-icons">delete</i>
                        </button>
                        @include('admin.product.deletemodal')
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for=""><strong>Name</strong></label>
                            <p>{{ $product->name }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for=""><strong>product</strong></label>
                            <p>{{ $product->category->name }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for=""><strong>Slug</strong></label>
                            <p>{{ $product->slug }}</p>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for=""><strong>Small Description</strong></label>
                            <textarea rows="3" class="form-control border px-2" readonly>{{ $product->small_description }}</textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for=""><strong>Description</strong></label>
                            <textarea rows="3" class="form-control border px-2" readonly>{{ $product->description }}</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for=""><strong>Price</strong></label>
                            <p>{{ $config->currency_simbol }}{{ number_format($product->original_price,2, '.', ',') }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for=""><strong>Discount Price</strong></label>
                            <p>{{ $config->currency_simbol }}{{ number_format($product->selling_price,2, '.', ',') }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for=""><strong>Quantity</strong></label>
                            <p>{{ $product->qty }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for=""><strong>Tax</strong></label>
                            <p>{{ $product->tax }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status"
                                    {{ $product->status == 1 ? 'checked' : '' }} disabled>
                                <label class="form-check-label" for="flexSwitchCheckDefault"><strong>Status</strong></label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="popular"
                                    {{ $product->trending == 1 ? 'checked' : '' }} disabled>
                                <label class="form-check-label" for="flexSwitchCheckDefault"><strong>Trending</strong></label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="discount"
                                    {{ $product->discount == 1 ? 'checked' : '' }} disabled>
                                <label class="form-check-label" for="flexSwitchCheckDefault"><strong>Discount</strong></label>
                            </div>
                        </div>
                        @if ($product->image)
                            <div class="col-md-12 mb-3">
                                <img class="border-radius-md w-25"
                                    src="{{ asset('assets/uploads/product/' . $product->image) }}" alt="product Image">
                            </div>
                        @endif
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        {{-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p> --}}
                    </div>
                </div>
            </div>

        </div>
    @endsection

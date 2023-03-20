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
                    <div class="row">

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <a href="{{ url('add-product') }}" class="btn btn-success">
                                    <i class="material-icons opacity-10">add</i> Add Product
                                </a>
                                <form action="{{ url('pdf-product') }}" method="GET" target="_blank">
                                    <input type="hidden" name="rproduct" value="{{ $queryProduct }}">
                                    <input type="hidden" name="rcategory" value="{{ $queryCategory }}">
                                    <input type="hidden" name="rstock" value="{{ $queryStock }}">
                                    <input type="hidden" name="rstatus" value="{{ $queryStatus }}">
                                    <input type="hidden" name="rtrending" value="{{ $queryTrending }}">
                                    <input type="hidden" name="rdiscount" value="{{ $queryDiscount }}">
                                    <button type="submit" class="btn btn-danger float-end">
                                        <i class="material-icons opacity-10">picture_as_pdf</i> PDF
                                    </button>
                                </form>

                            </div>
                            @include('admin.product.search')
                            <div class="table-responsive">
                                <table class="table table-sm align-products-center mb-0 table-striped table-bordered">
                                    <thead>
                                        <tr>

                                            {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th> --}}
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Category</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Price</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Stock</th>
                                            {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Image</th> --}}
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                        <tr>
                                            {{-- @if ($product->status == 0)
                                                <td class="align-middle text-center text-sm"><span class="badge bg-gradient-danger">Disabled</span></td>
                                            @else
                                                <td class="align-middle text-center text-sm"><span class="badge bg-gradient-success">Enabled</span></td>
                                            @endif --}}

                                            <td>

                                                <div class="d-flex px-2 py-1">
                                                    @if ($product->image)
                                                        <div>
                                                            <img src="{{ asset('assets/uploads/product/'.$product->image) }}" class="avatar avatar-sm me-3">
                                                        </div>
                                                    @endif
                                                    <div class="d-flex flex-column">
                                                        <strong><a href="{{ url('show-product/'.$product->id) }}">{{ $product->name }}</a></strong>
                                                        <p class="text-xs text-secondary mb-0">
                                                            @if ($product->status == 0)
                                                                <span class="badge bg-gradient-danger">Disabled</span>
                                                            @else
                                                                <span class="badge bg-gradient-success">Enabled</span>
                                                            @endif
                                                            @if ($product->trending == 1)
                                                                <span class="badge bg-gradient-primary">Trending</span>
                                                            @endif
                                                            @if ($product->discount == 1)
                                                                <span class="badge bg-gradient-warning">discount</span>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm"><a href="{{ url('show-category/'.$product->Idcategory) }}">{{ $product->Category }}</a></td>
                                            <td class="align-middle text-center text-sm">
                                                @if ($product->discount == 0)
                                                    {{ $config->currency_simbol }}{{ number_format($product->original_price,2, '.', ',') }}
                                                @else
                                                {{ $config->currency_simbol }}{{ number_format($product->selling_price,2, '.', ',') }}
                                                    <strike>{{ $config->currency_simbol }}{{ number_format($product->original_price,2, '.', ',') }}</strike>
                                                @endif

                                            </td>
                                            <td class="align-middle text-center text-sm">{{ $product->qty }}</td>
                                            {{-- <td class="align-middle text-center text-sm">
                                                @if ($product->image)
                                                    <img class="border-radius-md w-10" src="{{ asset('assets/uploads/product/'.$product->image) }}" alt="{{ $product->name }} image">
                                                @endif
                                            </td> --}}
                                            <td class="align-middle text-center text-sm">
                                                <a href="{{ url('show-product/'.$product->id) }}" type="button" class="btn btn-info"><i class="material-icons">visibility</i></a>
                                                <a href="{{ url('edit-product/'.$product->id) }}" type="button" class="btn btn-warning"><i class="material-icons">edit</i></a>
                                                <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $product->id }}">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                            </td>
                                        </tr>
                                        @include('admin.product.deletemodal')
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    {{-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p> --}}
                    {{ $products->links() }}
                </div>
            </div>
        </div>

    </div>
@endsection

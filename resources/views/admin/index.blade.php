@extends('layouts.admin')

@section('content')
    <div class="row">

        {{-- <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
            <div class="card background">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <div class="text-center pt-1">
                        <h4 class="mb-0">Dashboard</h4>
                    </div>
                    <hr class="dark horizontal my-0">
                </div> --}}
                <div class="row mb-4">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-md-2 col-6">
                                <div class="card">
                                    <a href="{{ url('show-user/'.Auth::id()) }}">
                                        <div class="card-header mx-4 p-3 text-center">
                                            <div
                                                class="icon icon-shape icon-lg bg-gradient-success shadow text-center border-radius-lg">
                                                <i class="material-icons opacity-10">person</i>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0 p-3 text-center">
                                            {{-- <h6 class="text-center mb-0">Salary</h6>
                                            <span class="text-xs">Belong Interactive</span> --}}
                                            <hr class="horizontal dark my-3">
                                            <h5 class="mb-0">My Profile</h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-2 col-6">
                                <div class="card">
                                    <a href="{{ url('categories') }}">
                                        <div class="card-header mx-4 p-3 text-center">
                                            <div
                                                class="icon icon-shape icon-lg bg-gradient-info shadow text-center border-radius-lg">
                                                <i class="material-icons opacity-10">category</i>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0 p-3 text-center">
                                            {{-- <h6 class="text-center mb-0">Paypal</h6>
                                            <span class="text-xs">Freelance Payment</span> --}}
                                            <hr class="horizontal dark my-3">
                                            <h5 class="mb-0">Categories</h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-2 col-6">
                                <div class="card">
                                    <a href="{{ url('products') }}">
                                        <div class="card-header mx-4 p-3 text-center">
                                            <div
                                                class="icon icon-shape icon-lg bg-gradient-info shadow text-center border-radius-lg">
                                                <i class="material-icons opacity-10">sell</i>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0 p-3 text-center">
                                            {{-- <h6 class="text-center mb-0">Paypal</h6>
                                            <span class="text-xs">Freelance Payment</span> --}}
                                            <hr class="horizontal dark my-3">
                                            <h5 class="mb-0">Products</h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-2 col-6">
                                <div class="card">
                                    <a href="{{ url('orders') }}">
                                        <div class="card-header mx-4 p-3 text-center">
                                            <div
                                                class="icon icon-shape icon-lg bg-gradient-info shadow text-center border-radius-lg">
                                                <i class="material-icons opacity-10">local_shipping</i>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0 p-3 text-center">
                                            {{-- <h6 class="text-center mb-0">Paypal</h6>
                                            <span class="text-xs">Freelance Payment</span> --}}
                                            <hr class="horizontal dark my-3">
                                            <h5 class="mb-0">Orders</h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-2 col-6">
                                <div class="card">
                                    <a href="{{ url('users') }}">
                                        <div class="card-header mx-4 p-3 text-center">
                                            <div
                                                class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                                <i class="material-icons opacity-10">people_alt</i>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0 p-3 text-center">
                                            {{-- <h6 class="text-center mb-0">Paypal</h6>
                                            <span class="text-xs">Freelance Payment</span> --}}
                                            <hr class="horizontal dark my-3">
                                            <h5 class="mb-0">Users</h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-2 col-6">
                                <div class="card">
                                    <a href="{{ url('config') }}">
                                        <div class="card-header mx-4 p-3 text-center">
                                            <div
                                                class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                                <i class="material-icons opacity-10">settings</i>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0 p-3 text-center">
                                            {{-- <h6 class="text-center mb-0">Paypal</h6>
                                            <span class="text-xs">Freelance Payment</span> --}}
                                            <hr class="horizontal dark my-3">
                                            <h5 class="mb-0">Settings</h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-12">

                    {{-- LAST ORDERS --}}
                    <div class="col-lg-4 col-md-6 mb-md-0 mb-4">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="row">
                                    <div class="col-lg-6 col-7">
                                        <h6>Last Orders</h6>
                                        <p class="text-sm mb-0">
                                            <i class="fa fa-check text-success" aria-hidden="true"></i>
                                            <span class="font-weight-bold ms-1">{{ $completeOrders->count() }}</span> Complete
                                        </p>
                                        <p class="text-sm mb-0">
                                            <i class="far fa-clock text-danger" aria-hidden="true"></i>
                                            <span class="font-weight-bold ms-1">{{ $pendingOrders->count() }}</span> Pending
                                        </p>
                                    </div>
                                    <div class="col-lg-6 col-5 my-auto text-end">
                                        <a href="{{ url('orders') }}" class="btn btn-outline-info">View all orders<span>({{ $allOrders->count() }})</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Date</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Status</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                            <tr>

                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm"><a href="{{ url('admin/show-order/'.$order->id) }}">{{ date('d-m-Y', strtotime($order->created_at)) }}</a></h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm"><a href="{{ url('admin/show-order/'.$order->id) }}">{{ $order->status == '0' ?'Pending' : 'Completed' }}</a></h6>
                                                            </div>
                                                        </div>

                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <span class="text-xs font-weight-bold"><a href="{{ url('admin/show-order/'.$order->id) }}"> {{ $config->currency_simbol }}{{ number_format($order->total_price,2, '.', ',') }} </a></span>
                                                    </td>

                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- LAST PRODUCTS --}}

                    <div class="col-lg-4 col-md-6 mb-md-0 mb-4">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="row">
                                    <div class="col-lg-6 col-7">
                                        <h6>Top Popular Products</h6>
                                        {{-- <p class="text-sm mb-0">
                                            <i class="fa fa-check text-success" aria-hidden="true"></i>
                                            <span class="font-weight-bold ms-1">{{ $popularProducts->count(); }}</span> Complete
                                        </p>
                                        <p class="text-sm mb-0">
                                            <i class="far fa-clock text-danger" aria-hidden="true"></i>
                                            <span class="font-weight-bold ms-1">{{ $pendingOrders->count() }}</span> Pending
                                        </p> --}}
                                    </div>
                                    <div class="col-lg-6 col-5 my-auto text-end">
                                        <a href="{{ url('orders') }}" class="btn btn-outline-info">View all products<span>({{ $allProducts->count() }})</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Product</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Stock</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Orders</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($popularProducts as $product)
                                            <tr>

                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm"><a href="{{ url('show-product/'.$product->product->id) }}">{{ $product->product->name }}</a></h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <span class="text-xs font-weight-bold"><a href="{{ url('show-product/'.$product->product->id) }}">{{ $product->product->qty }}</a></span>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <span class="text-xs font-weight-bold"><a href="{{ url('show-product/'.$product->product->id) }}">{{ $product->count }}</a></span>
                                                    </td>

                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- stock alert --}}

                    <div class="col-lg-4 col-md-6 mb-md-0 mb-4">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="row">
                                    <div class="col-lg-6 col-7">
                                        <h6>Stock Alert</h6>
                                        {{-- <p class="text-sm mb-0">
                                            <i class="fa fa-check text-success" aria-hidden="true"></i>
                                            <span class="font-weight-bold ms-1">{{ $popularProducts->count(); }}</span> Complete
                                        </p>
                                        <p class="text-sm mb-0">
                                            <i class="far fa-clock text-danger" aria-hidden="true"></i>
                                            <span class="font-weight-bold ms-1">{{ $pendingOrders->count() }}</span> Pending
                                        </p> --}}
                                    </div>
                                    <div class="col-lg-6 col-5 my-auto text-end">
                                        <a href="{{ url('orders') }}" class="btn btn-outline-info">View all products<span>({{ $allProducts->count() }})</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Product</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Stock</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($stockAlerts as $product)
                                            <tr>

                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm"><a href="{{ url('show-product/'.$product->id) }}">{{ $product->name }}</a></h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <span class="text-xs font-weight-bold"><a href="{{ url('show-product/'.$product->id) }}">{{ $product->qty }}</a></span>
                                                    </td>

                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div align="center">
                                        {{ $stockAlerts->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

    </div>
@endsection

@extends('layouts.admin')

@section('content')
    <div class="row">

        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">local_shipping</i>
                    </div>
                    <div class="text-center pt-1">
                        {{-- <p class="text-sm mb-0 text-capitalize">Today's Money</p> --}}
                        <h4 class="mb-0">Orders</h4>
                    </div>
                    <hr class="dark horizontal my-0">
                </div>
                <div class="card-body p-3 pt-2">
                    <div class="row">

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <a href="{{ url('order-history') }}" class="btn btn-warning float-end">
                                    <i class="material-icons opacity-10">history</i> Order History
                                </a>

                            </div>
                            <div class="table-responsive">
                                <table class="table table-sm align-products-center mb-0 table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Order Date</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tracking Number</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Payment Mode</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                        <tr align="center">
                                            <td class="align-middle text-center text-sm">{{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                                            <td class="align-middle text-center text-sm"><strong><a href="{{ url('show-order/'.$order->id) }}">{{ $order->tracking_no }}</a></strong></td>
                                            <td class="align-middle text-center text-sm">{{ number_format($order->total_price,2, '.', ',') }}</td>
                                            <td class="align-middle text-center text-sm">{{ $order->status == '0' ?'Pending' : 'Completed' }}</td>
                                            <td class="align-middle text-center text-sm">{{ $order->payment_mode }} @if ($order->payment_id != null)  ({{ $order->payment_id }}) @endif</td>
                                            <td class="align-middle text-center text-sm">
                                                <a href="{{ url('admin/show-order/'.$order->id) }}" type="button" class="btn btn-info"><i class="material-icons">visibility</i></a>
                                                {{-- <a href="{{ url('edit-product/'.$order->id) }}" type="button" class="btn btn-warning"><i class="material-icons">edit</i></a>
                                                <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $order->id }}">
                                                    <i class="material-icons">delete</i>
                                                </button> --}}
                                            </td>
                                        </tr>
                                        {{-- @include('admin.product.deletemodal') --}}
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
                </div>
            </div>
        </div>

    </div>
@endsection

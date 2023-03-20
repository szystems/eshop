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
                                <form action="{{ url('pdf-order') }}" method="GET" target="_blank">
                                    <input type="hidden" name="rdesde" value="{{ $queryDesde }}">
                                    <input type="hidden" name="rhasta" value="{{ $queryHasta }}">
                                    <input type="hidden" name="rstatus" value="{{ $queryStatus }}">
                                    <input type="hidden" name="rpayment" value="{{ $queryPayment }}">
                                    <button type="submit" class="btn btn-danger float-end">
                                        <i class="material-icons opacity-10">picture_as_pdf</i> PDF
                                    </button>
                                </form>

                            </div>
                            {{-- <div class="col-md-12 mb-3">
                                <a href="{{ url('order-history') }}" class="btn btn-warning float-end">
                                    <i class="material-icons opacity-10">history</i> Order History
                                </a>

                            </div> --}}
                            @include('admin.orders.search')
                            <div class="table-responsive">
                                <table class="table table-sm align-products-center mb-0 table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Order Date</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Tracking Number</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Total</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Status</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Payment Mode</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr align="center">
                                                <td class="align-middle text-center text-sm">
                                                    {{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                                                <td class="align-middle text-center text-sm"><strong><a
                                                            href="{{ url('show-order/' . $order->id) }}">{{ $order->tracking_no }}</a></strong>
                                                </td>
                                                <td class="align-middle text-center text-sm">

                                                    {{ $config->currency_simbol }}{{ number_format($order->total_price, 2, '.', ',') }}
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    {{ $order->status == '0' ? 'Pending' : 'Completed' }}</td>
                                                <td class="align-middle text-center text-sm">{{ $order->payment_mode }}
                                                    @if ($order->payment_id != null)
                                                        ({{ $order->payment_id }})
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <a href="{{ url('admin/show-order/' . $order->id) }}" type="button"
                                                        class="btn btn-info"><i class="material-icons">visibility</i></a>
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
                                {{ $orders->links() }}
                            </div>

                        </div>

                    </div>

                </div>

                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">

                    <div class="row">
                        <div class="col-12">
                            <div class="card my-4">
                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                    <div class="bg-gradient-secondary shadow-secondary border-radius-lg pt-4 pb-3">
                                        <h6 class="text-white text-capitalize ps-3">Resume</h6>
                                    </div>
                                </div>

                                @php
                                    $total = 0;
                                    $totaltax = 0;
                                    $completeorders = 0;
                                    $desde = date("d-m-Y", strtotime($desde));
                                    $hasta = date("d-m-Y", strtotime($hasta));
                                    $totalorders = $ordersResume->count();

                                @endphp
                                @foreach ($ordersResume as $resume)
                                    @php
                                        $total += $resume->total_price;
                                        $totaltax += $resume->total_tax;
                                        $completeorders += $resume->status;
                                    @endphp
                                @endforeach
                                <div class="card-body px-0 pb-2">
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center justify-content-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Date:</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Completed Orders ({{ $completeorders }}/{{ $totalorders }})</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">SubTotal</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Total Tax</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td>
                                                        <div class="align-middle text-center">
                                                            <div class="my-auto">
                                                                <h6 class="mb-0 text-sm"><small> From: </small><u>{{ $desde }}</u> <small>To: </small><u>{{ $hasta }}</u></h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @php
                                                            if ($totalorders == 0) {
                                                                $totalorders = 0.00001;
                                                            }
                                                            $average = (($completeorders / $totalorders)*100);
                                                        @endphp
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <span class="me-2 text-xs font-weight-bold">{{ number_format($average, 0, '.', ',') }}%</span>
                                                            <div>
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="{{ $average }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $average }}%;"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle" align="center">
                                                        <font color="limegreen"><strong>{{ $config->currency_simbol }}{{ number_format($total-$totaltax, 2, '.', ',') }}</strong></font>

                                                    </td>
                                                    <td class="align-middle" align="center">
                                                        <font color="red"><strong>{{ $config->currency_simbol }}{{ number_format($totaltax, 2, '.', ',') }}</strong></font>

                                                    </td>

                                                    <td class="align-middle" align="center">
                                                        <font color="blue"><strong>{{ $config->currency_simbol }}{{ number_format($total, 2, '.', ',') }}</strong></font>

                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>

    </div>
@endsection

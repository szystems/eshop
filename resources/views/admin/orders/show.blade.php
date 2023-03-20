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
                    <h4><u>Order Details</u></h4>
                    <div>
                        <form action="{{ url('pdf-showorder') }}" method="GET" target="_blank">
                            <input type="hidden" name="rorderid" value="{{ $order->id }}">
                            <button type="submit" class="btn btn-danger float-end">
                                <i class="material-icons opacity-10">picture_as_pdf</i> PDF
                            </button>
                        </form>
                        {{-- <a href="{{ url('edit-order/'.$order->id) }}" type="button" class="btn btn-warning"><i class="material-icons">edit</i></a> --}}
                        {{-- <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $order->id }}">
                            <i class="material-icons">delete</i>
                        </button>
                        @include('admin.product.deletemodal') --}}
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>First Name</strong></label>
                            <p>{{ $order->fname }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>Last Name</strong></label>
                            <p>{{ $order->lname }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>Email</strong></label>
                            <p>{{ $order->email }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>Phone</strong></label>
                            <p>{{ $order->phone }}</p>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for=""><strong>Shipping Address</strong></label>
                            <p>
                                {{ $order->address1 }},
                                @if ($order->address2 != null)
                                    {{ $order->address2 }}
                                @endif
                                {{ $order->city }},
                                {{ $order->state }},
                                {{ $order->country }}.
                            </p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>Zip Code</strong></label>
                            <p>{{ $order->zipcode }}</p>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for=""><strong>Tracking No.</strong></label>
                            <p>{{ $order->tracking_no }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>Order Date</strong></label>
                            <p>{{ date('d-m-Y', strtotime($order->created_at)) }}</p>
                        </div>
                        {{-- <div class="col-md-2 mb-3">
                            <label for=""><strong>Status</strong></label>
                            <p>{{ $order->status == '0' ? 'Pending' : 'Completed' }}</p>
                        </div> --}}
                        <div class="col-md-2 mb-3">
                            <form action="{{ url('update-order/'.$order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <label for=""><strong>Order Status:</strong></label>
                                <select class="form-select" name="order_status" aria-label="Floating label select example">
                                    <option {{ $order->status == '0'? 'Selected':'' }} value="0">Pending</option>
                                    <option {{ $order->status == '1'? 'Selected':'' }} value="1">Completed</option>
                                </select>
                                <button type="submit" class="btn btn-warning px-7">Update</button>
                            </form>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>Payment Mode</strong></label>
                            <p>{{ $order->payment_mode }}</p>
                        </div>
                        @if ($order->payment_id != null)
                            <div class="col-md-3 mb-3">
                                <label for=""><strong>Payment ID</strong></label>
                                <p>{{ $order->payment_id }}</p>
                            </div>
                        @endif
                        <div class="col-md-2 mb-3">

                        </div>
                        @if ($order->note != null)
                            <div class="col-md-12 mb-3">
                                <label for=""><strong>Note</strong></label>
                                <p>{{ $order->note }}</p>
                            </div>
                        @endif

                    </div>
                    <div class="row">
                        <h4><u>Order Products</u></h4>
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                @php
                                    $total = 0;
                                @endphp
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Quantity</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SubTotal</th>
                                        {{-- <th class="text-secondary opacity-7">Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderItems as $item)
                                        @php
                                            if ($item->discount == "1") {
                                                $price = $item->selling_price;
                                            }else {
                                                $price = $item->original_price;
                                            }
                                        @endphp
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ asset('assets/uploads/product/'.$item->image) }}" class="avatar avatar-sm me-3">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-xs">{{ $item->Product }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $item->Category }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            @if ($item->discount == "1")
                                            <td class="align-middle text-center">
                                                {{ $config->currency_simbol }}{{ number_format($item->price,2, '.', ',') }} <br>
                                                <span class="text-secondary text-xs font-weight-normal"><strike>{{ $config->currency_simbol }}{{ number_format($item->original_price,2, '.', ',') }}</strike></span>

                                            </td>
                                            @else
                                                <td class="align-middle text-center">
                                                    {{ $config->currency_simbol }}{{ number_format($item->price,2, '.', ',') }}

                                                </td>
                                            @endif
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-normal">{{ $item->qty }}</span>
                                                @php
                                                    $total +=  $price * $item->qty;
                                                    $subtotal =  $price * $item->qty;
                                                @endphp
                                            </td>
                                            <td class="align-middle text-center">
                                                {{ $config->currency_simbol }}{{ number_format($subtotal,2, '.', ',') }}
                                            </td>
                                            {{-- <td class="align-middle text-center">
                                                {{ number_format($subtotal,2, '.', ',') }}
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    @if ($order->total_tax != 0)
                                        <tr>
                                            @php
                                                $tax_total = $order->total_tax;
                                                $total = $total + $tax_total;
                                            @endphp
                                            <td></td>
                                            <td></td>
                                            <td class="align-middle text-center"></td>
                                            <td class="align-middle text-center"><h8> Tax: <strong>{{ $config->currency_simbol }}{{ number_format($tax_total,2, '.', ',') }}</strong></h8></td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="align-middle text-center"></td>
                                        <td class="align-middle text-center"><h4>Total: <strong>{{ $config->currency_simbol }}{{ number_format($total,2, '.', ',') }}</strong></h4></td>
                                    </tr>
                                </tfoot>
                            </table>
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

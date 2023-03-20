<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Pure css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css"
        integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">


    <title>Order Details</title>

</head>

<body>
    <center>
        <img align="center" src="{{ $imagen }}" alt="" height="100">
    </center>
    <h3 align="center"><u>Order Details</u></h3>
    <label>
        <font size="1">Report Date:</font>
        <font color="blue" size="1">
            @php
                $now = date('d-m-Y');
            @endphp
            {{ $now }}
        </font>
    </label>
    <br>

    <table class="pure-table pure-table-bordered" Width=100%>
        <thead>
            <tr>
                <th align="right">
                    <font size="1">First Name:</font>
                </th>
                <td align="left">
                    <font size="1">{{ $order->fname }}</font>
                </td>
                <th align="right">
                    <font size="1">Last Name:</font>
                </th>
                <td>
                    <font size="1">{{ $order->lname }}</font>
                </td>
            </tr>
            <tr>
                <th align="right">
                    <font size="1">Email:</font>
                </th>
                <td>
                    <font size="1">{{ $order->email }}</font>
                </td>
                <th align="right">
                    <font size="1">Phone:</font>
                </th>
                <td>
                    <font size="1">{{ $order->phone }}</font>
                </td>
            </tr>
            <tr>
                <th align="right">
                    <font size="1">Shipping Address 1:</font>
                </th>
                <td colspan="3">
                    <font size="1">{{ $order->address1 }}</font>
                </td>
            </tr>
            <tr>
                <th align="right">
                    <font size="1">Shipping Address 2:</font>
                </th>
                <td colspan="3">
                    <font size="1">{{ $order->address2 }}</font>
                </td>
            </tr>
            <tr>
                <th align="right">
                    <font size="1">Zipcode:</font>
                </th>
                <td>
                    <font size="1">{{ $order->zipcode }}</font>
                </td>
                <th align="right">
                    <font size="1">Tracking No:</font>
                </th>
                <td>
                    <font size="1">{{ $order->tracking_no }}</font>
                </td>
            </tr>
            <tr>
                <th align="right">
                    <font size="1">Order Date:</font>
                </th>
                <td>
                    <font size="1">{{ date('d-m-Y', strtotime($order->created_at)) }}</font>
                </td>
                <th align="right">
                    <font size="1">Order Status:</font>
                </th>
                <td>
                    <font size="1">{{ $order->status }}</font>
                </td>
            </tr>
            <tr>
                <th align="right">
                    <font size="1">Payment Mode:</font>
                </th>
                <td colspan="3">
                    <font size="1">{{ $order->payment_mode }} @if ($order->payment_mode == "Paid by PayPal") ({{ $order->payment_id }})  @endif</font>
                </td>
            </tr>
            <tr>
                <th align="right">
                    <font size="1">Note:</font>
                </th>
                <td colspan="3">
                    <font size="1">{{ $order->note }}</font>
                </td>
            </tr>
        </thead>

        {{-- <tbody>
            <tr>
                <td align="right">
                    <font size="1">Image:</font>
                </td>
                <td align="center" colspan="3">



                </td>
            </tr>
        </tbody> --}}

    </table>

    <h5><u>Product Details:</u></h5>

    <table class="pure-table pure-table-bordered" Width=100%>
        @php
            $total = 0;
        @endphp
        <thead>
            <tr>
                <th>
                    <font size="1">Product</font>
                </th>
                <th>
                    <font size="1">Price</font>
                </th>
                <th>
                    <font size="1">Quantity</font>
                </th>
                <th>
                    <font size="1">SubTotal</font>
                </th>
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
                    <td align="center">
                        <font size="1">{{ $item->Product }}
                    </td>
                    @if ($item->discount == 1)
                        <td align="right">
                            <font size="1" color="blue">
                                {{ $currency }}{{ number_format($item->price, 2, '.', ',') }}</font>
                            <br>
                            <strike>
                                <font size="1" color="red">
                                    {{ $currency }}{{ number_format($item->original_price, 2, '.', ',') }}</font>
                            </strike>
                        </td>
                    @else
                        <td align="right">
                            <font size="1" color="blue">
                                {{ $currency }}{{ number_format($item->price, 2, '.', ',') }}</font>
                        </td>
                    @endif
                    <td align="center">
                        <font size="1">{{ $item->qty }}</font>
                        @php
                            $total +=  $price * $item->qty;
                            $subtotal =  $price * $item->qty;
                        @endphp
                    </td>
                    <td align="right">
                        {{ $config->currency_simbol }}{{ number_format($subtotal,2, '.', ',') }}
                    </td>
                </tr>
            @endforeach
            @if ($order->total_tax != 0)
                <tr>
                    @php
                        $tax_total = $order->total_tax;
                        $total = $total + $tax_total;
                    @endphp
                    <td colspan="3" align="right">
                        Tax:
                    </td>
                    <td align="right">
                        {{ $config->currency_simbol }}{{ number_format($tax_total,2, '.', ',') }}</>
                    </td>
                </tr>
            @endif
            <tr>
                <td colspan="3" align="right">
                    <b>Total:</b>
                </td>
                <td align="right">
                    <b>{{ $config->currency_simbol }}{{ number_format($total,2, '.', ',') }}</b>
                </td>
            </tr>
        </tbody>
    </table>

</body>

</html>

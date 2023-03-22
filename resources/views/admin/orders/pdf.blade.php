<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Pure css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css"
        integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">


    <title>Orders</title>

</head>

<body>
    <center>
        <img align="center" src="{{ $imagen }}" alt="" height="100">
    </center>
    <h3 align="center"><u>Orders List</u></h3>
    <label>
        <font size="1">Report Date:</font>
        <font color="blue" size="1">
            @php
                $horafecha = new DateTime("now", new DateTimeZone(Auth::user()->timezone));
                $horafecha = $horafecha->format('d-m-Y, H:i:s')
            @endphp
            {{ $horafecha }} ({{ Auth::user()->timezone }})
        </font>
    </label>
    <br>
    <label for="">
        <font size="1"><strong><u>Filter by:</u></strong></font>
    </label>
    <br>
    <label for="">
        <font size="1">From: </font>
        <font size="1" color="blue">{{ date('d-m-Y', strtotime($desde)) }}</font>
    </label>
    <label for="">
        <font size="1">to: </font>
        <font size="1" color="blue">{{ date('d-m-Y', strtotime($hasta)) }}</font>
    </label>
    <label for="">
        <font size="1">Status: </font>
        <font size="1" color="blue">
            @if ($queryStatus != null)
                {{ $queryStatus == '0' ? 'Pending' : 'Completed' }}
            @else
                All
            @endif
        </font>
    </label>
    <label for="">
        <font size="1">Payment: </font>
        <font size="1" color="blue">
            @if ($queryPayment != null) {{ $queryPayment }} @if ($queryPayment != null)
                @endif
            @else
                All @endif
        </font>
    </label>
    <h5><u>Resume:</u></h5>
    <table class="pure-table pure-table-bordered" Width=100%>
        <thead>
            <tr>
                <th>
                    <font size="1">Date</font>
                </th>
                <th>
                    <font size="1">Completed</font>
                </th>
                <th>
                    <font size="1">SubTotal</font>
                </th>
                <th>
                    <font size="1">Total Tax</font>
                </th>
                <th>
                    <font size="1">Total</font>
                </th>
            </tr>
        </thead>
        <tbody>
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
                <tr>
                    <td align="center">
                        <font size="1">From: <strong>{{ date('d-m-Y', strtotime($desde)) }}</strong> To: <strong>{{ date('d-m-Y', strtotime($hasta)) }}</strong></font>
                    </td>
                    <td align="center">
                        <font size="1">({{ $completeorders }}/{{ $totalorders }})</font>
                    </td>
                    <td align="right">
                        <font size="1">{{ $config->currency_simbol }}{{ number_format($total-$totaltax, 2, '.', ',') }}</font>
                    </td>
                    <td align="center">
                        <font size="1">{{ $config->currency_simbol }}{{ number_format($totaltax, 2, '.', ',') }}</font>
                    </td>
                    <td align="center">
                        <font size="1"><strong>{{ $config->currency_simbol }}{{ number_format($total, 2, '.', ',') }}</strong></font>
                    </td>
                </tr>
        </tbody>
    </table>
    <h5><u>Orders List:</u></h5>
    <table class="pure-table pure-table-bordered" Width=100%>
        <thead>
            <tr>
                <th>

                    <font size="1">Order Date</font>
                </th>
                <th>
                    <font size="1">Tracking Number</font>
                </th>
                <th>
                    <font size="1">Total</font>
                </th>
                <th>
                    <font size="1">Status</font>
                </th>
                <th>
                    <font size="1">Payment </font>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td align="center">
                        @php
                            $date = new DateTime($order->created_at, new DateTimeZone(date_default_timezone_get()));
                            $date->setTimezone(new DateTimeZone(Auth::user()->timezone));
                        @endphp
                        <font size="1">{{ $date->format('d-m-Y') }}</font>
                    </td>
                    <td align="center">
                        <font size="1">{{ $order->tracking_no }}</font>
                    </td>
                    <td align="right">
                        <font size="1">
                            {{ $config->currency_simbol }}{{ number_format($order->total_price, 2, '.', ',') }}</font>
                    </td>
                    <td align="center">
                        <font size="1">{{ $order->status == '0' ? 'Pending' : 'Completed' }}
                    </td>
                    <td align="center">
                        <font size="1">{{ $order->payment_mode }} @if ($order->payment_id != null)
                                ({{ $order->payment_id }})
                            @endif
                        </font>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>

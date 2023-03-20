<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Pure css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css"
        integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">


    <title>Products List</title>

</head>

<body>
    <center>
        <img align="center" src="{{ $imagen }}" alt="" height="100">
    </center>
    <h3 align="center"><u>Product List</u></h3>
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
    <label for="">
        <font size="1"><strong><u>Filter by:</u></strong></font>
    </label>
    <br>
    <label for="">
        <font size="1">Product: </font>
        <font size="1" color="blue">
            @if ($queryProduct != null) {{ $queryProduct }} @if ($queryProduct != null)
                @endif
            @else
                All @endif
        </font>
    </label>
    <label for="">
        <font size="1">Category: </font>
        <font size="1" color="blue">
            @if ($queryCategory != null) {{ $queryCategory }} @if ($queryCategory != null)
                @endif
            @else
                All @endif
        </font>
    </label>
    <label for="">
        <font size="1">Stock: </font>
        <font size="1" color="blue">
            @if ($queryStock == ">=")
                All
            @elseif ($queryStock == "<=")
                Out of Stock
            @elseif ($queryStock == ">")
                With Stock
            @endif
        </font>
    </label>
    <label for="">
        <font size="1">Status: </font>
        <font size="1" color="blue">
            @if ($queryStatus != null)
                {{ $queryStatus == '0' ? 'Disabled' : 'Enabled' }}
            @else
                All
            @endif
        </font>
    </label>
    <label for="">
        <font size="1">Trending: </font>
        <font size="1" color="blue">
            @if ($queryTrending != null)
                {{ $queryTrending == '0' ? 'Disabled' : 'Enabled' }}
            @else
                All
            @endif
        </font>
    </label>
    <label for="">
        <font size="1">Discount: </font>
        <font size="1" color="blue">
            @if ($queryDiscount != null)
                {{ $queryDiscount == '0' ? 'Disabled' : 'Enabled' }}
            @else
                All
            @endif
        </font>
    </label>

    <table class="pure-table pure-table-bordered" Width=100%>
        <thead>
            <tr>
                <th>
                    <font size="1">Category</font>
                </th>
                <th>
                    <font size="1">Name</font>
                </th>
                <th>
                    <font size="1">Price</font>
                </th>
                <th>
                    <font size="1">Stock</font>
                </th>
                <th>
                    <font size="1">Image</font>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $item)
                <tr>
                    <td align="center">
                        <font size="1">{{ $item->Category }}
                    </td>
                    <td>
                        <font size="1">{{ $item->name }}</font>
                    </td>
                    @if ($item->discount == 1)
                        <td align="right">
                            <font size="1" color="blue">
                                {{ $currency }}{{ number_format($item->selling_price, 2, '.', ',') }}</font>
                            <br>
                            <strike>
                                <font size="1" color="red">
                                    {{ $currency }}{{ number_format($item->original_price, 2, '.', ',') }}</font>
                            </strike>
                        </td>
                    @else
                        <td align="right">
                            <font size="1" color="blue">
                                {{ $currency }}{{ number_format($item->original_price, 2, '.', ',') }}</font>
                        </td>
                    @endif
                    <td align="center">
                        <font size="1">{{ $item->qty }}</font>
                    </td>
                    <td align="center">
                        @if ($item->image != null)
                            <img align="center" src="{{ $path . '/product/' . $item->image }}" alt=""
                                height="50">
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

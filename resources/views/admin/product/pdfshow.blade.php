<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Pure css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css"
        integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">


    <title>Product Details</title>

</head>

<body>
    <center>
        <img align="center" src="{{ $imagen }}" alt="" height="100">
    </center>
    <h3 align="center"><u>{{ $product->name }}</u></h3>
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

    <table class="pure-table pure-table-bordered" Width=100%>
        <thead>
            <tr>
                <th align="right">
                    <font size="1">Category:</font>
                </th>
                <td align="left">
                    <font size="1">{{ $product->category->name }}</font>
                </td>
                <th align="right">
                    <font size="1">Name:</font>
                </th>
                <td>
                    <font size="1">{{ $product->name }}</font>
                </td>
            </tr>
            <tr>
                <th align="right">
                    <font size="1">Code:</font>
                </th>
                <td>
                    <font size="1">{{ $product->code }}</font>
                </td>
                <th align="right">
                    <font size="1">Slug:</font>
                </th>
                <td>
                    <font size="1">{{ $product->slug }}</font>
                </td>
            </tr>
            <tr>
                <th align="right">
                    <font size="1">Small Description:</font>
                </th>
                <td colspan="3">
                    <font size="1">{{ $product->small_description }}</font>
                </td>
            </tr>
            <tr>
                <th align="right">
                    <font size="1">Description:</font>
                </th>
                <td colspan="3">
                    <font size="1">{{ $product->description }}</font>
                </td>
            </tr>
            <tr>
                <th align="right">
                    <font size="1">Price:</font>
                </th>
                <td>
                    <font size="1">
                        @if($product->discount == 1)
                        {{ $currency }}{{ number_format($product->selling_price, 2, '.', ',') }} <strike>{{ $currency }}{{ number_format($product->original_price, 2, '.', ',') }}</strike>
                        @else
                            {{ $currency }}{{ number_format($product->original_price, 2, '.', ',') }}
                        @endif
                    </font>
                </td>
                <th align="right">
                    <font size="1">Stock:</font>
                </th>
                <td>
                    <font size="1">{{$product->qty}}</font>
                </td>
            </tr>
            @if ($product->image != null)
            <tr>
                <th align="right">
                    <font size="1">Image:</font>
                </th>
                <td align="center" colspan="3">
                    <img src="{{ $path . '/product/' . $product->image }}" alt="" height="400">
                </td>
            </tr>
            @endif
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
</body>

</html>

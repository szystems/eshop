<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Pure css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css" integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">


    <title>Products List</title>

  </head>
  <body>
    <h1 align="center"><u>Products List</u></h1>
    <legend>A Stacked Form</legend>
        <label for="stacked-email">Email</label>
    <table class="pure-table pure-table-bordered" Width=100%>
        <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td align="center">{{ $item->Category }}</td>
                @if ($item->discount == 1)
                    <td align="right">
                        {{number_format($item->selling_price,2, '.', ',')}}
                        <br>
                        <strike>{{number_format($item->original_price,2, '.', ',')}}</strike>
                    </td>
                @else
                    <td align="right">{{number_format($item->original_price,2, '.', ',')}}</td>
                @endif

                <td align="center">
                    @if ($item->image != null)
                        <img align="center" src="{{$path.$item->image}}" alt="" height="100">
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
  </body>
</html>

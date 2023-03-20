<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Pure css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css"
        integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">


    <title>User Profile</title>

</head>

<body>
    <center>
        <img align="center" src="{{ $imagen }}" alt="" height="100">
    </center>
    <h3 align="center"><u>User Profile</u></h3>
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
                    <font size="1">Role:</font>
                </th>
                <td align="left">
                    <font size="1">{{ $user->role_as }}</font>
                </td>
                <th align="right">
                    <font size="1">Name:</font>
                </th>
                <td>
                    <font size="1">{{ $user->name }}</font>
                </td>
            </tr>
            <tr>
                <th align="right">
                    <font size="1">Email:</font>
                </th>
                <td>
                    <font size="1">{{ $user->email }}</font>
                </td>
                <th align="right">
                    <font size="1">Phone:</font>
                </th>
                <td>
                    <font size="1">{{ $user->phone }}</font>
                </td>
            </tr>
            <tr>
                <th align="right">
                    <font size="1">Adress 1:</font>
                </th>
                <td colspan="3">
                    <font size="1">{{ $user->address1 }}</font>
                </td>
            </tr>
            <tr>
                <th align="right">
                    <font size="1">Adress 2:</font>
                </th>
                <td colspan="3">
                    <font size="1">{{ $user->address2 }}</font>
                </td>
            </tr>
            <tr>
                <th align="right">
                    <font size="1">City:</font>
                </th>
                <td>
                    <font size="1">{{ $user->city }}</font>
                </td>
                <th align="right">
                    <font size="1">State:</font>
                </th>
                <td>
                    <font size="1">{{ $user->state }}</font>
                </td>
            </tr>
            <tr>
                <th align="right">
                    <font size="1">Country:</font>
                </th>
                <td>
                    <font size="1">{{ $user->country }}</font>
                </td>
                <th align="right">
                    <font size="1">Zipcode:</font>
                </th>
                <td>
                    <font size="1">{{ $user->zipcode }}</font>
                </td>
            </tr>

        </thead>
        {{-- <tbody>
            <tr>
                <td align="center">
                    <font size="1">hola</font>
                </td>
                <td align="center">
                    <font size="1">hola 2</font>
                </td>
            </tr>
        </tbody> --}}
    </table>
</body>

</html>

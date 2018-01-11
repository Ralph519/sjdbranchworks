<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" /> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>SJD Branch Works</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="{{ asset("/css/bootstrap.min.css")}}" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="{{ asset("/css/material-dashboard.css")}}" rel="stylesheet" />
    <link href="{{ asset("/css/prostyle.css")}}" rel="stylesheet" />

    <link href="{{ asset("/css/fontawesome.min.css")}}" rel="stylesheet" />
    <link href="{{ asset("/css/style.css")}}" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="{{ asset("/css/fonts.css")}}" rel="stylesheet" type='text/css'>
    <link href="{{ asset("/css/materialdesignicons.css")}}" rel="stylesheet" type='text/css'>

    <link href="{{ asset("/css/sweetalert.css")}}" rel="stylesheet" />
    <script src="{{ asset("/js/sweetalert.min.js")}}"></script>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
</head>

<body>
    @include('layouts.sidebar')
    @include('layouts.navbar')

    @yield('content')

    @include('layouts.footer')

    @include('sweet::alert')

</body>
@include('layouts.bottomscripts')

@yield('pagescripts')
</html>

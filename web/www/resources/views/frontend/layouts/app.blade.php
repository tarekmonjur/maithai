<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0">
    <title>MaiThai Kitchen | Home</title>
    <link rel="icon" href="{{asset('frontend/logo/logo.png')}}">
    <link rel="shortcut icon" href="{{asset('frontend/logo/logo.png')}}">
    <!-- CSS only -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/app.css')}}">
    @stack('style')
</head>

<body>
<!--------------- HEADER ------------------>
@include('frontend.layouts.common.header')

<!-------------------- NAVBAR -------------->
@include('frontend.layouts.common.navbar')

@yield('main_content')

<!-------------- FOOTER AREA ---------------->
@include('frontend.layouts.common.footer')

<!------------ Shopping cart Drawer ---------->
@include('frontend.layouts.common.cart')

</body>

<!-- JS, Popper.js, and jQuery -->
<!-- Bootstrap jQuery (3.5.1) -->
<script type="text/javascript" src="{{asset('frontend/js/jquery.min.js')}}"></script>

<!-- Bootstrap Popper.js (1.16.1) -->
<script type="text/javascript" src="{{asset('frontend/js/popper.min.js')}}"></script>

<!-- Bootstrap bootstrap.min.js (4.5.2) -->
<script type="text/javascript" src="{{asset('frontend/js/bootstrap.min.js')}}"></script>

<!-- Shopping Cart Custom JS -->
<script type="text/javascript" src="{{asset('frontend/js/cart.js')}}"></script>

@stack('script')

</html>

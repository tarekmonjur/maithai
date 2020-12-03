<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaiThai Kitchen | Home</title>
    <link rel="icon" href="{{asset('frontend/logo/logo.png')}}">

    <!-- CSS only -->
    <!-- Style.css, Custom CSS Here -->
    <!-- <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}"> -->
    <link rel="stylesheet" href="{{asset('frontend/css/app.css')}}">
    @stack('style')
</head>

<body>
<!--------------- HEADER ------------------>
@include('frontend.common.header')

<!-------------------- NAVBAR -------------->
@include('frontend.common.navbar')

@yield('main_content')

<!-------------- FOOTER AREA ---------------->
@include('frontend.common.footer')

<!------------ Shopping cart Drawer ---------->
@include('frontend.common.cart')

</body>

<!-- JS, Popper.js, and jQuery -->
<!-- FontAwesome 5 -->
<script src="{{asset('frontend/fontAwesome/js/all.min.js')}}"></script>
<script src="{{asset('frontend/fontAwesome/js/fontawesome.min.js')}}"></script>

<!-- Bootstrap jQuery (3.5.1) -->
<script src="{{asset('frontend/js/jquery.min.js')}}"></script>

<!-- Bootstrap Popper.js (1.16.1) -->
<script src="{{asset('frontend/js/popper.min.js')}}"></script>

<!-- Bootstrap bootstrap.min.js (4.5.2) -->
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>

<!-- Shopping Cart Custom JS -->
<script src="{{asset('frontend/js/cart.js')}}"></script>

@stack('script')

</html>

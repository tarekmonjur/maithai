<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaiThai Kitchen | Home</title>
    <link rel="icon" href="{{asset('frontend/logo/logo.png')}}">

    <!-- CSS only -->
    <!-- FontAwesome -->
    <link rel="stylesheet" href="{{asset('frontend/fontAwesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/fontAwesome/css/fontawesome.min.css')}}">

    <!-- Bootstrap (4.5.2) -->
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">

    <!-- Style.css, Custom CSS Here -->
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
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

@stack('script')

</html>

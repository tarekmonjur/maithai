<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <button class="navbar-toggler m-1" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav m-auto">
                <li class="nav-item @if($url_segment1 === null || $url_segment1 === '') active @endif">
                    <a class="nav-link @if($url_segment1 === null || $url_segment1 === '') active-now @endif" href="{{url('/')}}">home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item @if($url_segment1 === 'food-orders') active @endif">
                    <a class="nav-link @if($url_segment1 === 'food-orders') active-now @endif" href="{{url('/food-orders')}}">food order</a>
                </li>
                <li class="nav-item @if($url_segment1 === 'food-package') active @endif">
                    <a class="nav-link @if($url_segment1 === 'food-package') active-now @endif" href="{{url('/food-package')}}">food package</a>
                </li>
                <li class="nav-item @if($url_segment1 === 'login') active @endif">
                    <a class="nav-link @if($url_segment1 === 'login') active-now @endif" href="{{url('/login')}}">login & register</a>
                </li>
                <li class="nav-item @if($url_segment1 === 'about') active @endif">
                    <a class="nav-link @if($url_segment1 === 'about') active-now @endif" href="{{url('/about')}}">about us</a>
                </li>
                <li class="nav-item @if($url_segment1 === 'contact') active @endif">
                    <a class="nav-link @if($url_segment1 === 'contact') active-now @endif" href="{{url('/contact')}}">contact us</a>
                </li>
                <li class="nav-item @if($url_segment1 === 'terms-policy') active @endif">
                    <a class="nav-link @if($url_segment1 === 'terms-policy') active-now @endif" href="{{url('/terms-policy')}}">terms & policy</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
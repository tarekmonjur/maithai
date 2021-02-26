<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0">
    <title>{{$context['settings']['name']}} | {{$title}}</title>
    <link rel="icon" href="{{asset('files/logo.png')}}">
    <link rel="shortcut icon" href="{{asset('files/logo.png')}}">
    <!-- CSS only -->
    <link rel="stylesheet" type="text/css" href="{{asset(config('app.theme').'/css/app.css')}}">
    @foreach($styles as $style)
        <style href="{{asset(config('app.theme').'/css/'.$style.'.css')}}"></style>
    @endforeach
</head>

<body>
    <div id="app">
        <main-component></main-component>
    </div>
</body>

<script type="text/javascript">
  window._baseURL = '{{ url('/') }}';
  window._asset = '{{ asset('/') }}';
  window._assetPath = '{{ asset(config('app.asset_path')) }}';
  window._assetURL = '{{ asset(config('app.theme').'/') }}';
  window._context = '{{ base64_encode(json_encode($context??[])) }}';
  window.current_url = '{{url()->current()}}';
  window._filters = '{!! base64_encode(json_encode($filters??[])) !!}';
  window.data = '{!! base64_encode(json_encode($data??[])) !!}';
</script>

@foreach($scripts as $script)
    <script src="{{asset(config('app.theme').'/js/'.$script.'.js')}}"></script>
@endforeach
<script src="https://gateway.sumup.com/gateway/ecom/card/v2/sdk.js"></script>
</html>

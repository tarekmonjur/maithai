@extends('backend.layouts.app')

@push('style')
@foreach($styles as $style)
    <link rel="stylesheet" href="{{asset('backend/css/'.$style.'.css')}}">
@endforeach
@endpush

@section('main_content')
<div id="main_content" class="container-fluid">
    <main-conent-component></main-conent-component>
</div>
@endsection

@push('script')
    <script type="text/javascript">
      window._posURL = '{{ url(config('app.backend_home', 'pos')) }}';
      window._baseURL = '{{ url('/') }}';
      window._assetURL = '{{ asset('/backend') }}';
      window._columns_config = '{!! base64_encode(json_encode($columns_config??[])) !!}';
      window._filters_config = '{!! base64_encode(json_encode($filters_config??[])) !!}';
      window._context = '{{ base64_encode(json_encode($context??[])) }}';
    </script>
    @foreach($scripts as $script)
        <script src="{{asset('backend/js/'.$script.'.js')}}"></script>
    @endforeach
@endpush

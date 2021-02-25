@extends('frontend.layouts.app')

@push('style')
@foreach($styles as $style)
    <style href="{{asset('frontend/css/'.$style.'.css')}}"></style>
@endforeach
@endpush

@section('main_content')
<div id="main">
    <main-component></main-component>
</div>
@endsection

@push('script')
    <script type="text/javascript">
      window._baseURL = '{{ url('/') }}';
      window._asset = '{{ asset('/') }}';
      window._assetPath = '{{ asset(config('app.asset_path')) }}';
      window._assetURL = '{{ asset('frontend/') }}';
      window._context = '{{ base64_encode(json_encode($context??[])) }}';
    </script>
    @foreach($scripts as $script)
        <script src="{{asset('frontend/js/'.$script.'.js')}}"></script>
    @endforeach
@endpush

@extends('backend.layouts.app')

@push('style')
@foreach($styles as $style)
    <style href="{{asset('backend/css/'.$style.'.css')}}"></style>
@endforeach
@endpush

@section('main_content')
<div id="main_content" class="container-fluid">
    <main-conent-component></main-conent-component>
</div>
@endsection

@push('script')
    @foreach($scripts as $script)
        <script src="{{asset('backend/js/'.$script.'.js')}}"></script>
    @endforeach
@endpush

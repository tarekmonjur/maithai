@extends('backend.layouts.app')

@push('style')
@include('backend.layouts.common.datatable-style')
@foreach($csss as $css)
    <style href="{{asset('backend/css/'.$css.'.css')}}"></style>
@endforeach
@endpush

@section('main_content')
<div id="main_content" class="container-fluid">
    <categories-component></categories-component>
</div>
@endsection

@push('script')
@include('backend.layouts.common.datatable-script')
    @foreach($jss as $js)
        <script src="{{asset('backend/js/'.$js.'.js')}}"></script>
    @endforeach
@endpush

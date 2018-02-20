@extends('layouts.app')

@push('styles')
<link type="text/css" rel="stylesheet" href="{{url('vendor/font-awesome/font-awesome.min.css')}}">
    <style>
        body,html {
            padding:0;
            margin:0;
            height:100%;
        }
        .layout-wrapper{
            height:100%;
        }
    </style>
@endpush

@section('layout')
<div class="layout-wrapper">
    @yield('content')
</div>
@endsection




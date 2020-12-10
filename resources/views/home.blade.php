@extends('layouts.master')

@section('page_title', 'Home')
@section('page_subtitle', 'Dashboard')

@section('content')
    <!-- Dashboard realtor -->
    @cannot('is-admin-or-supervisor')
        @include('dashboard._realtor')
    @endcannot

    <!-- Dashboard supervisor -->
    @can('is-supervisor')
        @include('dashboard._supervisor')
    @endcan

    <!-- Dashboard administrator -->
    @can('is-admin')
        @include('dashboard._admin')
    @endcan
@endsection

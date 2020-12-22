@extends('layouts.master')

@section('page_title', 'Classificações dos corretores - ' . date('Y'))

@section('content')
    <div class="row">
        <!-- SEDE -->
        <div class="col">
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h4 class="text-success">Sede</h4>
                </div>
                <div class="card-body">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @foreach($placingSede as $realtor)
                            <li class="item">
                                <div class="product-img">
                                    <img
                                        src="{{ asset('storage/' . (Auth::user()->photo ?? '../images/no_photo.png')) }}"
                                        alt="Foto - {{ $realtor->name_short }}" class="img-size-50">
                                </div>
                                <div class="product-info">
                                    <span class="product-title">
                                        {{ $realtor->name_short }}
                                        <span class="badge badge-success float-right">{{ $loop->iteration }}º</span>
                                    </span>
                                    <span class="product-description">
                                       R$ {{ number_format($realtor->sale_value, 2, ',', '.') }}
                                    </span>
                                </div>
                            </li>
                            <!-- /.item -->
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- NOROESTE -->
        <div class="col">
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h4 class="text-danger">Noroeste</h4>
                </div>
                <div class="card-body">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @foreach($placingNoroeste as $realtor)
                            <li class="item">
                                <div class="product-img">
                                    <img
                                        src="{{ asset('storage/' . (Auth::user()->photo ?? '../images/no_photo.png')) }}"
                                        alt="Foto - {{ $realtor->name_short }}" class="img-size-50">
                                </div>
                                <div class="product-info">
                                    <span class="product-title">
                                        {{ $realtor->name_short }}
                                        <span class="badge badge-danger float-right">{{ $loop->iteration }}º</span>
                                    </span>
                                    <span class="product-description">
                                       R$ {{ number_format($realtor->sale_value, 2, ',', '.') }}
                                    </span>
                                </div>
                            </li>
                            <!-- /.item -->
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- ÁGUAS CLARAS -->
        <div class="col">
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h4 class="text-info">Águas Claras</h4>
                </div>
                <div class="card-body">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @foreach($placingAguasClaras as $realtor)
                            <li class="item">
                                <div class="product-img">
                                    <img
                                        src="{{ asset('storage/' . (Auth::user()->photo ?? '../images/no_photo.png')) }}"
                                        alt="Foto - {{ $realtor->name_short }}" class="img-size-50">
                                </div>
                                <div class="product-info">
                                    <span class="product-title">
                                        {{ $realtor->name_short }}
                                        <span class="badge badge-info float-right">{{ $loop->iteration }}º</span>
                                    </span>
                                    <span class="product-description">
                                       R$ {{ number_format($realtor->sale_value, 2, ',', '.') }}
                                    </span>
                                </div>
                            </li>
                            <!-- /.item -->
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- GERAL -->
        <div class="col">
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h4 class="text-navy">Geral</h4>
                </div>
                <div class="card-body">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @foreach($placingGeral as $realtor)
                            <li class="item">
                                <div class="product-img">
                                    <img
                                        src="{{ asset('storage/' . (Auth::user()->photo ?? '../images/no_photo.png')) }}"
                                        alt="Foto - {{ $realtor->name_short }}" class="img-size-50">
                                </div>
                                <div class="product-info">
                                    <span class="product-title">
                                        {{ $realtor->name_short }}
                                        <span class="badge bg-navy float-right">{{ $loop->iteration }}º</span>
                                    </span>
                                    <span class="product-description">
                                       R$ {{ number_format($realtor->sale_value, 2, ',', '.') }}
                                    </span>
                                </div>
                            </li>
                            <!-- /.item -->
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

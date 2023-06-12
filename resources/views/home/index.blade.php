@extends('layouts.baseuser')
@section('title', 'Home')
@section('content')
    <div>
        {{-- Ini view konten --}}
        <div class="container">
            {{--
            @if (Session::has('success'))
                <meta http-equiv="refresh" content="5;url={{ session('success') }}">
            @endif --}}
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <a href="{{ route('download-pdf', session('success')) }}" class="btn btn-primary">Download Antrian</a>
                </div>
            @endif
            <div class="banner">
                <img src="{{ url('assets/slider/banner.png') }}" alt="">
            </div>

            <section class="product mt-5 mb-5">
                <div class="row">
                    <div class="col-md-10">
                        <h3><strong>List Products</strong></h3>
                    </div>
                    {{-- <div class="col-md-2 d-grid gap">
                    <a href="{{route('products')}}" class="btn btn-dark"><i class="fa fa-eye" aria-hidden="true"
                            style="background-color: transparent"></i> Lihat Semua</a>
                </div> --}}
                </div>
                <div class="row mt-4">
                    @foreach ($products as $item)
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    @if ($item->status == 'Ada')
                                        <span
                                            class="position-absolute top-15 start-10 translate-middle p-2 bg-success border border-light rounded-circle">
                                            <span class="visually-hidden">New alerts</span>
                                        </span>
                                    @else
                                        <span
                                            class="position-absolute top-15 start-10 translate-middle p-2 bg-danger border border-light rounded-circle">
                                            <span class="visually-hidden">New alerts</span>
                                        </span>
                                    @endif
                                    <img src="{{ url('product') }}/{{ $item->gambar }}" class="img-fluid">
                                    <div class="row mt-5">
                                        <div class="col-md-12">
                                            <h5><strong>{{ $item->nama }}</strong> </h5>
                                            <h5>Rp. {{ number_format($item->harga) }} </h5>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12 d-grid gap">
                                            <div class="row mt-2">
                                                <div class="col-md-12 d-grid gap">
                                                    <button href="#" class="btn btn-dark btn-block"
                                                        @if ($item->status == 'Habis') disabled @endif><i
                                                            class="fa fa-shopping-cart" aria-hidden="true"
                                                            style="background-color: transparent"></i>
                                                        Pesan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

        </div>
    </div>



@endsection

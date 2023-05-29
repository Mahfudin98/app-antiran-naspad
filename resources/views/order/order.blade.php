@extends('layouts.baseuser')
@section('title', 'Antrian & Order')
@section('content')
    <div>
        {{-- Ini view konten --}}
        <div class="container">
            <section class="product mb-5">
                <div class="row">
                    <div class="col-md-10">
                        <h3><strong>List Products</strong></h3>
                    </div>
                </div>
                <div class="row mt-4">
                    @foreach ($products as $item)
                        <div class="col-md-3 mb-4">
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
                                                    <button type="button" class="btn btn-dark btn-block"
                                                        data-bs-toggle="modal" data-bs-target="#modal{{ $item->id }}">
                                                        <i class="fa fa-shopping-cart" aria-hidden="true"
                                                            style="background-color: transparent"></i> Pesan
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- modal section --}}
                        <div class="modal fade" id="modal{{ $item->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <img src="{{ url('product') }}/{{ $item->gambar }}"
                                            class="rounded mx-auto d-block img-thumbnail" alt="...">
                                        <div class="d-flex justify-content-between mt-4">
                                            <h5><strong>{{ $item->nama }}</strong> </h5>
                                            <h5>Rp. {{ number_format($item->harga) }} </h5>
                                        </div>
                                        <form action="{{ route('order-to-cart') }}" method="POST"
                                            class="input-group mb-3">
                                            @csrf
                                            <input type="number" name="qty" class="form-control" value="1"
                                                aria-describedby="button-addon2">
                                            <input type="hidden" name="product_id" value="{{ $item->id }}"
                                                class="form-control">
                                            <button class="btn btn-primary" type="submit" id="button-addon2"> <i
                                                    class="fa fa-shopping-cart" aria-hidden="true"
                                                    style="background-color: transparent"></i> Pesan</button>
                                        </form>
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

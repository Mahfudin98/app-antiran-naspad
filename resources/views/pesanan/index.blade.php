@extends('layouts.base')
@section('title', 'Home')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Produts</h1>
        </div>
        @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center">No Antrian</th>
                                        <th class="text-center">Nama Customer</th>
                                        <th class="text-center">Pesanan</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Estimasi</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @php $no=1; @endphp
                                    @foreach ($pesanan as $key => $item)
                                        <tr>
                                            <td>{{ $item->nomor_antrian }}</td>
                                            <td>{{ $item->customer->name }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-block"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modal{{ $item->nomor_antrian }}">
                                                    <i class="fa fa-eye" aria-hidden="true"
                                                        style="background-color: transparent"></i> Pesanan
                                                </button>
                                                <div class="modal fade" id="modal{{ $item->nomor_antrian }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">#</th>
                                                                            <th scope="col">Nama Produk</th>
                                                                            <th scope="col">QTY</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($item->orderProduct as $index => $items)
                                                                            <tr>
                                                                                <td>{{ $no + $index }}</td>
                                                                                <td> {{ $items->nama_produk }} </td>
                                                                                <td> {{ $items->qty }} </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Rp. {{ number_format($item->total) }}</td>
                                            <td>
                                                {{ date('H:m', strtotime($item->estimasi)) }}
                                            </td>
                                            <td class="d-flex justify-content-center">
                                                @if ($item->status == 0)
                                                    @if ($key == $pesanan->where('status', '!=', 2)->count() - 1)
                                                        <form method="POST"
                                                            action="{{ route('pesanan.update', $item->id) }}">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-warning">
                                                                Proses Pesanan
                                                            </button>
                                                        </form>
                                                    @else
                                                        <button class="btn btn-warning" disabled>
                                                            Proses Pesanan
                                                        </button>
                                                    @endif
                                                @elseif ($item->status == 1)
                                                    <form method="POST" action="{{ route('pesanan.update', $item->id) }}">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-primary">
                                                            Selesai
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="badge bg-success">Pesanan Selesai</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

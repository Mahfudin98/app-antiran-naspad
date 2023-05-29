@extends('layouts.baseuser')
@section('title', 'Antrian & Order')
@section('content')
    <!--================Home Banner Area =================-->
    <section class="mb-4">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content text-center">
                    <h2>Keranjang Belanja</h2>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            @if (Session::has('message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="d-flex justify-content-center">
                <div class="table-responsive">
                    <form action="{{ route('order-update-cart') }}" method="post">
                        @csrf
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- LOOPING DATA DARI VARIABLE CARTS -->
                                @if (is_array($carts) || is_object($carts))
                                    @forelse ($carts as $row)
                                        <tr>
                                            <td>
                                                <div class="d-flex">
                                                    <img src="{{ url('product') }}/{{ $row['product_image'] }}"
                                                        width="100px" height="auto" class="img-thumbnail"
                                                        alt="{{ $row['product_name'] }}">
                                                </div>
                                                <p>{{ $row['product_name'] }}</p>
                                            </td>
                                            <td>
                                                <h5>Rp {{ number_format($row['product_price']) }}</h5>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <button
                                                        onclick="var result = document.getElementById('sst{{ $row['product_id'] }}'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                                        class="btn btn-danger" type="button">
                                                        <i class="fas fa-arrow-up"></i>
                                                    </button>
                                                    <input type="text" name="qty[]" id="sst{{ $row['product_id'] }}"
                                                        maxlength="12" value="{{ $row['qty'] }}" title="Quantity:"
                                                        class="input-text form-control qty">
                                                    <input type="hidden" name="product_id[]"
                                                        value="{{ $row['product_id'] }}" class="form-control">
                                                    <button
                                                        onclick="var result = document.getElementById('sst{{ $row['product_id'] }}'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                                                        class="btn btn-danger" type="button">
                                                        <i class="fas fa-arrow-down"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <td>
                                                <h5>Rp {{ number_format($row['product_price'] * $row['qty']) }}</h5>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada belanjaan</td>
                                        </tr>
                                    @endforelse
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada belanjaan</td>
                                    </tr>
                                @endif
                                <tr class="bottom_button">
                                    <td colspan="2">
                                        <button class="btn btn-warning">Update Cart</button>
                                    </td>
                                    <td colspan="2">
                                        <h5 class="text-end">
                                            Total: <strong>Rp {{ number_format($subtotal) }}</strong>
                                        </h5>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success" @disabled(is_array($carts) || (is_object($carts) && count($carts) != null) ? false : true) data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Pesan</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- modal checkout --}}
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('order-pay') }}">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Pesanan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" id="nama" placeholder="Nama kamu"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor HP</label>
                            <input type="tel" name="phone" class="form-control" id="phone"
                                placeholder="Nomor HP kamu" required>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                @if (is_array($carts) || is_object($carts))
                                    <h5>Pesanan Kamu</h5>
                                    <hr>
                                    @foreach ($carts as $row)
                                        <div class="row p-2 border-bottom">
                                            <div class="col">{{ $row['product_name'] }}</div>
                                            <div class="col">{{ $row['qty'] }} porsi</div>
                                            <div class="col">Rp {{ number_format($row['product_price'] * $row['qty']) }}
                                            </div>
                                        </div>
                                    @endforeach
                                    <hr>
                                    <h5 class="text-end">
                                        Total: <strong>Rp {{ number_format($subtotal) }}</strong>
                                    </h5>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Pesan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--================End Cart Area =================-->
@endsection

@extends('layouts.base')
@section('title', 'Products')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Produts</h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <a href="{{route('products.create')}}" class="btn btn-md btn-success mb-3"><i
                            class="fa fa-cart-plus" aria-hidden="true"></i>
                        TAMBAH</a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">Nama Produk</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Gambar</th>
                                    <th class="text-center">Edit/Remove</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @php $no=1; @endphp
                                @foreach($products as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->harga }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>
                                        <img src="{{asset('product/'.$item->gambar)}}" alt="" style="width: 50px">
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('products.edit', $item->id) }}"
                                            class="btn btn-primary btn-xs mb-1 mr-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('products.destroy', $item->id) }}" method="post"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('delete')

                                            <button class="btn btn-danger btn-xs mb-1">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
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
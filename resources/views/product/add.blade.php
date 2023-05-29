@extends('layouts.base')
@section('title', 'Tambah Product')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Product</h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="form-group ">
                        <a href="{{ route('products.index') }}" class="btn btn-warning" style="float: right"><i
                                class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <div class="col-md-6">
                        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="nama">Nama Product</label>
                                <input class="form-control @error('nama') is-invalid @enderror" id="nama" type="text"
                                    value="{{ old('nama')  }}" placeholder="Masukan Nama Product" name="nama"
                                    autocomplete="off">
                                @error('nama')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="harga">Harga</label>
                                <input class="form-control @error('harga') is-invalid @enderror" id="harga" type="text"
                                    value="{{ old('harga')}}" placeholder="Masukan Harga" name="harga"
                                    autocomplete="off">
                                @error('harga')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="status">Status</label>
                                <select name="status" class="form-control @error('status') is-invalid @enderror"
                                    id="status">
                                    <option value="{{ old('status') }}" hidden="">--Pilih Status--
                                    </option>
                                    <option value="Ada">Ada</option>
                                    <option value="Habis">Habis</option>
                                </select>
                                @error('status')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1">Gambar</label>
                                <input class="form-control @error('gambar') is-invalid @enderror" type="file"
                                    value="{{ old('gambar') }}" placeholder="Masukan Gambar" name="gambar">
                                @error('gambar')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">SIMPAN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
            $('#select2-component').select2();
        });
</script>
@endpush
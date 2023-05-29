@extends('layouts.base')
@section('title', 'Tambah User')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah User</h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="form-group ">
                        <a href="{{ route('users.index') }}" class="btn btn-warning" style="float: right"><i
                                class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <div class="col-md-6">
                        <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlInput1">Nama</label>
                                <input class="form-control @error('name') is-invalid @enderror" id="
                                                            exampleFormControlInput1" type="text"
                                    value="{{ old('name') }}" placeholder="Masukan Nama" name="name" autocomplete="off"
                                    autofocus>
                                @error('name')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1">Email</label>
                                <input class="form-control @error('email') is-invalid @enderror" id="
                                                            exampleFormControlInput1" type="email"
                                    value="{{ old('email') }}" placeholder="Masukan Email" name="email"
                                    autocomplete="off">
                                @error('email')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="no_hp">No Hp</label>
                                <input class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" type="text"
                                    value="{{ old('no_hp') }}" placeholder="Masukan No Hp" name="no_hp"
                                    autocomplete="off">
                                @error('no_hp')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password">Password</label>
                                <input class="form-control @error('password') is-invalid @enderror" id="password"
                                    type="password" value="{{ old('password') }}" placeholder="Masukan Password"
                                    name="password">
                                @error('password')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1">Konfirmasi Password</label>
                                <input class="form-control @error('password') is-invalid @enderror" id=""
                                    type="password" value="{{ old('password_confirmation') }}"
                                    placeholder="Masukan Konfirmasi Password" name="password_confirmation">
                                @error('password')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="level">Level</label>
                                <select name="level" class="form-control  @error('level') is-invalid @enderror"
                                    id="level">
                                    <option value="">-- Pilih Level--</option>
                                    <option value="Admin" {{ old('level')=='Admin' ? 'selected' : '' }}>
                                        Admin</option>
                                    <option value="User" {{ old('level')=='User' ? 'selected' : '' }}>
                                        User</option>
                                </select>
                                @error('level')
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
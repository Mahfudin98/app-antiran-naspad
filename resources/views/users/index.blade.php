@extends('layouts.base')
@section('title', 'Users')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Users</h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <a href="{{ route('users.create') }}" class="btn btn-md btn-success mb-3"><i class="fa fa-user-plus"
                            aria-hidden="true"></i> TAMBAH</a>
                    <a href="{{ route('exportpdf') }}" class="btn btn-md btn-secondary mb-3"><i class="fa fa-download"
                            aria-hidden="true"></i> EXPORT PDF</a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">No Hp</th>
                                    <th class="text-center">Posisi</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @php $no=1; @endphp
                                @foreach($users as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->no_hp }}</td>
                                    <td>{{ $item->level }}</td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('users.edit', $item->id) }}"
                                            class="btn btn-primary btn-xs mb-1 mr-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('users.destroy', $item->id) }}" method="post"
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
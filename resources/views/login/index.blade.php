@extends('layouts.baselogin')
@section('title', 'Login')
@section('content')

<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="main d-flex align-items-center justify-content-center">
            <div class="col-lg-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Silahkan Login!</h1>
                                    </div>

                                    @if (session('status'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{session('message')}}
                                    </div>
                                    @endif

                                    @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        @foreach ($errors->all() as $error)
                                        {{$error}}
                                        @endforeach
                                    </div>
                                    @endif

                                    <form class="user" action="proses-login" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control form-control-user" name="email"
                                                placeholder="Masukan Email" autofocus required value="{{old('email')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control form-control-user"
                                                name="password" placeholder="Masukan Password" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" type="submit">
                                            Login
                                        </button>
                                    </form>
                                    <div class="text-center mt-2">
                                        <a class="small" href="{{route('register')}}">Buat akun?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>

@endsection
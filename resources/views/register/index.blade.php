@extends('layouts.baselogin')
@section('title', 'Register')
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
                                        <h1 class="h4 text-gray-900 mb-4">Silahkan Daftar!</h1>
                                    </div>

                                    @if (session('status'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
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

                                    <form class="user" action="proses-register" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input type="text" class="form-control form-control-user" name="name"
                                                placeholder="Masukan Nama Lengkap" value="{{ old('name')}}" autofocus>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control form-control-user" name="email"
                                                placeholder="Masukan Email" value="{{ old('email')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control form-control-user"
                                                name="password" placeholder="Masukan Password"
                                                value="{{ old('password')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" class="form-control form-control-user" name="no_hp"
                                                placeholder="Masukan Phone" value="{{ old('no_hp')}}">
                                        </div>
                                        <div class="form-group mt-2 mb-4">
                                            <label>Captcha</label>
                                            <div class="captcha mb-2">
                                                <span>{!!captcha_img('math')!!}</span>
                                                <button type="button" class="btn btn-success reload" id="reload">
                                                    <i class="fa-solid fa-rotate-right"></i>
                                                </button>
                                            </div>
                                            <input type="text" class="form-control form-control-user" name="captcha"
                                                placeholder="Masukan Captcha">
                                        </div>
                                        {{-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div> --}}
                                        <button class="btn btn-primary btn-user btn-block" type="submit">
                                            Daftar
                                        </button>
                                    </form>
                                    <div class="text-center mt-2">
                                        <small>Sudah punya akun?</small> <a class="small" href="{{route('login')}}"
                                            style="text-decoration: none">Login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script>
        $('#reload').click(function(){
                $.ajax({
                    type:'GET',
                    url:'reload-captcha',
                    success:function(data){
                        $(".captcha span").html(data.captcha)
                    }
                });
            });
    </script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>

@endsection
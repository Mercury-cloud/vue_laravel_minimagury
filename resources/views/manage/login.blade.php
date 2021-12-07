@extends('manage.layout.login')
@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="{{ route("manage.login") }}"><b>minimaguri</b>管理画面</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
        <p class="login-box-msg">ログイン</p>
        {!! Form::open() !!}
            <div class="input-group mb-3">
                {!! Form::text("email", null, ['placeholder' => 'ログインメールアドレス', 'class' => 'form-control '. (($errors->has('email') ? 'is-invalid' : ''))]) !!}
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                    </div>
                </div>
                {!! $errors->first('email', '<span class="error invalid-feedback">:message</span>') !!}
            </div>

            <div class="input-group mb-3">
                {{-- <input type="password" class="form-control" placeholder="Password"> --}}
                {!! Form::password("password", ["placeholder" => 'パスワード', 'class' => 'form-control '. (($errors->has('password') ? 'is-invalid' : ''))]) !!}
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                    </div>
                </div>
                {!! $errors->first('password', '<span class="error invalid-feedback">:message</span>') !!}
            </div>
            <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">
                    ログインを記憶する
                </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">ログイン</button>
            </div>
            <!-- /.col -->
            </div>
        {!! Form::close() !!}


        {{-- <p class="mb-1">
            <a href="forgot-password.html">I forgot my password</a>
        </p>
        <p class="mb-0">
            <a href="register.html" class="text-center">Register a new membership</a>
        </p> --}}
        </div>
        <!-- /.login-card-body -->
    </div>

    @if(session()->has('error'))
    <div class="bg-gradient-danger mt-3">
        <div class="card-body">
          {{ session()->get('error') }}
        </div>
        <!-- /.card-body -->
    </div>
    @endif
</div>
@endsection
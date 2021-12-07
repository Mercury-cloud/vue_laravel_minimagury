@extends('manage.layout.app')

@section('css')
@endsection

@section('img')
@endsection

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">ユーザー管理</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<section class="content">
  {{-- <div class="container-fluid"> --}}
    <div class="row">
      <div class="col-12">
        <div class="card card-info">
          <!-- /.card-header -->
          <!-- form start -->
            <div class="card-body">
              {{ Form::model($user ,['class' =>'form-horizontal' ]) }}
              <div class="form-group row">
                <label for='name' class="col-sm-2 col-form-label">名前</label>
                <div class="col-sm-10">
                  {!! Form::text('name',null, ['id'=>'name','class'=>'form-control '. $errors->first('name', 'is-invalid') ,'placeholder'=>'入力してください']) !!}
                  {!! $errors->first('name', '<small class="text-danger">:message</small>') !!}
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">メールアドレス</label>
                <div class="col-sm-10">
                  {!! Form::text('email',null, ['id'=>'email','class'=>'form-control '. $errors->first('email', 'is-invalid') ,'placeholder'=>'入力してください']) !!}
                  {!! $errors->first('email', '<small class="text-danger">:message</small>') !!}
                </div>
                </div>
              <div class="form-group row">
                <label for='password' class="col-sm-2 col-form-label">パスワード</label>
                <div class="col-sm-10">
                   {!! Form::password('password', ['id'=>'password','class'=>'form-control '. $errors->first('password', 'is-invalid'),'placeholder'=>'新規登録する場合は入力してください']) !!}
                   {!! $errors->first('password', '<small class="text-danger">:message</small>') !!}
                </div>

              </div>

              {{Form::submit('保存する',['class'=>'btn btn-primary'])}}
              {{Form::close()}}
            </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

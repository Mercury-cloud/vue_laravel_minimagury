@extends('manage.layouts.app')

@section('css')
@endsection

@section('img')
@endsection

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">アカウント管理</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard v1</li>
        </ol>
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
              {{Form::model($manager ,['class' =>'form-horizontal' ])}}
              <div class="form-group row">
                <label for='name' class="col-sm-2 col-form-label">名前</label>
                <div class="col-sm-10">
                  {!! Form::text('name',null, ['id'=>'name','class'=>'form-control '. $errors->first('name', 'is-invalid') ,'placeholder'=>'入力してください']) !!}
                  {!! $errors->first('name', '<small class="text-danger">:message</small>') !!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">タイプ</label>
                <div class="col-sm-10">
                  {!! Form::select('type',[
                    'admin'=>'管理者',
                    'staff'=>'スタッフ',
                ],null,['class'=>'form-control']) !!}
                  {!! $errors->first('type', '<small class="text-danger">:message</small>') !!}
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">E-mail</label>
                <div class="col-sm-10">
                  {!! Form::text('email',null, ['id'=>'email','class'=>'form-control '. $errors->first('email', 'is-invalid') ,'placeholder'=>'入力してください']) !!}
                  {!! $errors->first('email', '<small class="text-danger">:message</small>') !!}
                </div>
                </div>
              <div class="form-group row">
                <label for='password' class="col-sm-2 col-form-label">パスワード</label>
                <div class="col-sm-10">
                    {!! Form::password('password', ['id'=>'password','class'=>'form-control','placeholder'=>' 変更する場合のみ入力してください']) !!}
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

@extends('manage.layout.app')

@section('css')
@endsection

@section('img')
@endsection

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">ユーザー一覧</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
  <!-- /.content-header -->

  <!-- Main content -->
  
  <section class="content">
    {{-- {{Form::open(['class' =>'container-fluid' ])}} --}}
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title"></h3>
  
                  <div class="input-group input-group-sm">
                    <ul class="nav nav-pills ml-auto">
                      <li class="nav-item">
                        <a class="nav-link active" href='{{route('manage.user.add')}}'>新規追加</a>
                      </li>  
                    </ul>
                  </div>
                </div>
                <!-- /.card-header -->

                
                  <div class="card-body table-responsive" style="height: 700px;">
                  <table class="table table-head-fixed text-nowrap table-bordered">
                    <thead>
                      <tr>
                        <th>名前</th>
                        <th>メールアドレス</th>
                        <th>編集</th>
                        <th>削除</th>
                　　　　</tr>
                    </thead>
                    <tbody>
                      @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td> 
                            <td>
                              <a href="{{ route('manage.user.edit', $user) }}" class="btn btn-sm btn-block btn-outline-secondary">編集</a>
                            </td>
                            <td>
                              <a onclick='return confirm("この操作を行うと関連するデータが削除されます。\n\n本当に削除しますか？");' href="{{route('manage.user.delete',$user)}}"  class="btn btn-sm btn-block btn-outline-danger">削除</a>
                            </td> 
                            {{-- <td>{{$manager->password}}</td>  --}}
                        </tr>
                       @endforeach
                      </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>

        
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection
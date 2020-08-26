@extends('layouts.app')

@section('page_title')
    edit  roles
@endsection

@section('content')




  <!-- Main content -->
  <section class="content">







    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">edit roles</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">

        @include('functions.validation_errors')

        {!! Form::model($model , [
            'action' => ['RoleController@update' , $model->id],
            'method' => 'PUT'
        ]) !!}

        @include('roles.form')
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Edit Role</button>
        </div>

        {!! Form::close() !!}


      </div>
      <!-- /.box-body -->
      </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->


@endsection

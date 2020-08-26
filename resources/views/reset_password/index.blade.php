@extends('layouts.app')
@section('page_title')
    Contacts
@endsection
@section('small_title')
    Contacts
@endsection

@section('content')




  <!-- Main content -->
  <section class="content">







    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">list of Contact from Client</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
            <div class="form-group">


                {!! Form::open([
                     'action' => 'ResetAdminPasswordController@update',
                    'method' => 'put',
                ]) !!}

                    <label for="email">email</label>
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}

                    <label for="password">password</label>
                    {!! Form::password('password', ['class' => 'form-control']) !!}

                    <label for="password-confirmed">confirm password</label>
                    {!! Form::password('password-confirmed', ['class' => 'form-control']) !!}

                    <button type="submit" class="btn btn-primary">reset password</button>

                {!! Form::close() !!}


            </div>



      </div>
      <!-- /.box-body -->
      </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->


@endsection

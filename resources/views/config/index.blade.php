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


                {!! Form::model( $row ,[
                     'action' => ['ConfigController@update', $row->id ],
                    'method' => 'post',
                    'files' => true
                ]) !!}

                    <label for="image">image</label>
                    {!! Form::file('icon', ['class' => 'form-control']) !!}

                    <label for="email">email</label>
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}

                    <label for="application_phone">application_phone</label>
                    {!! Form::text('application_phone', null, ['class' => 'form-control']) !!}

                    <label for="instgram_url">instgram_url</label>
                    {!! Form::url('instgram_url', null, ['class' => 'form-control']) !!}

                    <label for="twitter_url">twitter_url</label>
                    {!! Form::url('twitter_url', null, ['class' => 'form-control']) !!}

                    <label for="youtube_url">youtube_url</label>
                    {!! Form::url('youtube_url', null, ['class' => 'form-control']) !!}

                    <label for="googleplus_url">googleplus_url</label>
                    {!! Form::url('googleplus_url', null, ['class' => 'form-control']) !!}

                    <label for="whatsapp_url">whatsapp_url</label>
                    {!! Form::url('whatsapp_url', null, ['class' => 'form-control']) !!}

                    <label for="content">content</label>
                    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}

                    <button type="submit" class="btn btn-primary">edit</button>

                {!! Form::close() !!}


            </div>



      </div>
      <!-- /.box-body -->
      </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->


@endsection

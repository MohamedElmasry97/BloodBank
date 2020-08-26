@extends('layouts.app')

@section('page_title')
    Categories
@endsection
@section('small_title')
Categories
@endsection

@section('content')




  <!-- Main content -->
  <section class="content">







    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">list of Categories</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
      <a class="btn btn-primary" href="{{url(route('category.create'))}}"><i class="fa fa-plus"></i>New Category</a>
        @if (count($records))
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr >
                            <th>#</th>
                            <th class="text-center">NAME</th>
                            <th class="text-center">EDIT</th>
                            <th class="text-center">DELETE</th>
                        </tr>
                    </thead>

                    <tbody class="text-center">
                        @foreach ($records as $record)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                            <td><a href="{{ url(route('category.post.index' , $record->id))}}">{{$record->type}}</a></td>
                                <td>
                                <a href="{{url(route('category.edit' , $record->id))}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                                </td>
                                <td>

                                    {!! Form::open([
                                        'action' => ['CategoryController@destroy' , $record->id],
                                        'method' => 'DELETE'
                                    ]) !!}

                                        <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>

                                    {!! Form::close() !!}

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-dengar " role="alert">
                no data found
            </div>
        @endif


      </div>
      <!-- /.box-body -->
      </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->


@endsection

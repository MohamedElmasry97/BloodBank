@extends('layouts.app')

@section('page_title')
    Donations
@endsection
@section('small_title')
Donations
@endsection

@section('content')




  <!-- Main content -->
  <section class="content">







    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">list of Donations</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">

            {!! Form::open([
                'method' => 'get',
                'action' => 'DonationController@index'
            ]) !!}
            @include('functions.search')
            <br>

        @if (count($records))
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr >
                            <th>#</th>
                            <th class="text-center">NAME</th>
                            <th class="text-center">Blood Type</th>
                            <th class="text-center">age</th>
                            <th class="text-center">no. bags</th>
                            <th class="text-center">phone</th>
                            <th class="text-center">hospital_name</th>
                            <th class="text-center">City</th>
                            <th class="text-center">longitude</th>
                            <th class="text-center">latitude</th>
                            <th class="text-center">Note</th>
                            <th class="text-center">Delete</th>
                        </tr>
                    </thead>

                    <tbody class="text-center">
                        @foreach ($records as $record)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$record->name}}</td>
                                <td>{{$record->bloodType->name}}</td>
                                <td>{{$record->age}}</td>
                                <td>{{$record->no_bags}}</td>
                                <td>{{$record->phone}}</td>
                                <td>{{$record->hospital_name}}</td>
                                <td>{{$record->city->name}}</td>
                                <td>{{$record->longitude}}</td>
                                <td>{{$record->latitude}}</td>
                                <td>{{$record->note}}</td>
                                <td>

                                    {!! Form::open([
                                        'action' => ['DonationController@destroy', $record->id],
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

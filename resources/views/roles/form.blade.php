@inject('permissions', 'App\Models\Permission')

<div class="form-group">

    <label for="name">Name</label>
    {!! Form::text('name' , null , [
        'class' => 'form-control'
    ]) !!}

</div>
<div class="form-group">

    <label for="display_name">Display Name</label>
    {!! Form::text('display_name' , null , [
        'class' => 'form-control'
    ]) !!}

</div>
<div class="form-group">

    <label for="description">description</label>
    {!! Form::textarea('description' , null , [
        'class' => 'form-control'
    ]) !!}

</div>
<div class="form-group">

    <label for="permission">permission</label>
    <br>
    <input type="checkbox" id='select-all'><label for="select-all"> Select All</label>
    <div class="row">
        @foreach ($permissions->all() as $permission)
        <div class="col-sm-3">
            <div class="checkbox">
              <label>
              <input type="checkbox"  name="permission_list[]" value="{{$permission->id}}"
              @if ($model->hasPermission($permission->name))
                  checked
              @endif
              >
                {{$permission->display_name}}
              </label>
            </div>
        </div>
        @endforeach
    </div>
</div>


@push('scripts')
    <script>
    $("#select-all").click(function(){
        $("input[type=checkbox]").prop('checked' , $(this).prop('checked'))
    });
    </script>
@endpush


<div class="form-group">

    <label for="title">Title</label>
    {!! Form::text('title' , null , [
        'class' => 'form-control'
    ]) !!}

    <label for="data">data</label>
    {!! Form::text('data' , null , [
        'class' => 'form-control'
    ]) !!}


<label for="image">image</label>
{!! Form::file('image' , [
    'class' => 'form-control'
]) !!}
</div>

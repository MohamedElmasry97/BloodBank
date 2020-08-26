@inject('role', 'App\Models\Role')
@php
    $roles = $role->pluck('display_name' , 'id')->toArray();
@endphp

<div class="form-group">

    <label for="name">Name</label>
    {!! Form::text('name' , null , ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="email">email</label>
    {!! Form::email('email' , null , ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="password">password</label>
    {!! Form::password('password' , ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="password_confirmation">confirm password</label>
    {!! Form::password('password_confirmation' , ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="roles_list">Roles list</label>
    {!! Form::select('roles_list[]', $roles , null, ['class' => 'form-control' ,'multiple'=>'multiple']); !!}
</div>



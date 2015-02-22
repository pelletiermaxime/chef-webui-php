@extends('_layouts.default')

@section('main')
{!! Form::model($role, ['route' => 'roles.store']) !!}

<h1>Edit role</h1>

<div class="form-group">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'readonly']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Description') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

{!! Form::hidden('action', 'edit') !!}
{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}
@stop


@extends('_layouts.default')

@section('main')
{!! Form::open(array('route' => 'roles.store')) !!}

<h1>Create role</h1>

<div class="form-group">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Description') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}
@stop


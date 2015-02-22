@extends('_layouts.default')

@section('main')
{!! Form::open(array('route' => 'nodes.storeCreate')) !!}

<h1>Create node</h1>

<div class="form-group">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}
@stop


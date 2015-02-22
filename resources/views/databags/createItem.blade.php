@extends('_layouts.default')

@section('main')
{!! Form::open(['route' => 'databags.store']) !!}

{!! Form::hidden('databag_item', $item) !!}

<h1>Create item for databag <b>{{ $item }}</b></h1>

<div class="form-group">
    {!! Form::label('id', 'ID') !!}
    {!! Form::text('id', null, ['class' => 'form-control']) !!}
</div>

@include('databags.addFields')

{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}
@stop


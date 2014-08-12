@extends('_layouts.default')

@section('main')
{{ Form::model($item, array('route' => 'databags.store')) }}

{{ Form::hidden('databag_name', '') }}

<div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', null, ['class' => 'form-control']) }}
</div>

{{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
{{Form::close()}}
@stop


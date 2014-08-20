@extends('_layouts.default')

@section('main')
{{ Form::open(array('route' => 'databags.store')) }}

{{ Form::hidden('databag_item', $item) }}

<h1>Create item for databag <b>{{ $item }}</b></h1>

<div class="form-group">
    {{ Form::label('id', 'ID') }}
    {{ Form::text('id', null, ['class' => 'form-control']) }}
    <button type="button" class="btn btn-default add_field">Add field</button>
</div>

@if (isset(Input::old('item_name')))
    @foreach (Input::old('item_name') as $fieldNo => $item_name)
    <script>fieldNumber++;</script>
    <div class="form-group">
        <label for="item_name">Item name</label>
        <input class="form-control item_name" type="text"
            name="item_name[]" value="{{ $item_name }}" id="item_name_{{ $fieldNo + 1 }}">
        <label for="item_value">Item value</label>
        <input class="form-control item_value" type="text"
            name="item_value[]" value="{{ Input::old('item_value')[$fieldNo] }}" id="item_value_{{ $fieldNo + 1 }}">
        <button type="button" class="btn btn-default add_field">Add field</button>
        <button type="button" class="btn btn-default remove_field">Remove field</button>
    </div>
    @endforeach
@endif

<div class="form-group hidden add_field_template">
    <label for="item_name">Item name</label>
    <input id="item_name" class="form-control item_name" type="text">
    <label for="item_value">Item value</label>
    <input id="item_value" class="form-control item_value" type="text">
    <button type="button" class="btn btn-default add_field">Add field</button>
    <button type="button" class="btn btn-default remove_field">Remove field</button>
</div>

{{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
{{Form::close()}}
@stop


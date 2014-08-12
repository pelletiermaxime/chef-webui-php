@extends('_layouts.default')

@section('main')
{{ Form::model($item, array('route' => 'databags.store')) }}

    {{ Form::hidden('item_name', $info['item_name']) }}
    {{ Form::hidden('databag_name', $info['databag_name']) }}

    @foreach ($item as $field => $value)
    <?php
    $attributes = [];
    $attributes['class'] = 'form-control';
    if ($field == 'id') {
        $attributes[] = 'readonly';
    }
    ?>
    <div class="form-group">
        {{ Form::label($field, $field) }}
    @if (strlen($value) > 120)
        {{ Form::textarea($field, null, $attributes) }}
     @else
        {{ Form::text($field, null, $attributes) }}
     @endif
    </div>
    @endforeach

    {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
{{Form::close()}}
@stop


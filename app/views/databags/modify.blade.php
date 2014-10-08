@extends('_layouts.default')

@section('main')
{{ Form::model($item, array('route' => 'databags.store')) }}

    <h1>Edit databag item <b>{{ $info['item_name'] }}</b></h1>

    {{ Form::hidden('item_name', $info['item_name']) }}
    {{ Form::hidden('databag_item', $info['databag_name']) }}
    {{ Form::hidden('action', 'modify') }}

    <?php $fieldNo = 0 ?>
    @foreach ($item as $field => $value)
    <div class="form-group">
    <?php
    $attributes = [];
    $attributes['class'] = 'form-control';
    if ($field == 'id') {
        $attributes[] = 'readonly';
        echo Form::label('id', 'ID');
        echo Form::text('id', $value, $attributes);
        echo '</div>';
        continue;
    }
    $fieldNo++;
    $attributes['id'] ="item_value_{$fieldNo}";
    ?>
        {{ Form::label($field, $field) }}
        {{ Form::hidden('item_name[]', $field) }}
    @if (strlen($value) > 120)
        {{ Form::textarea('item_value[]', $value, $attributes) }}
     @else
        {{ Form::text('item_value[]', $value, $attributes) }}
     @endif
    </div>
    @endforeach

    {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
{{Form::close()}}
@stop


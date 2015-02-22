@foreach ($item as $field => $value)
    <div class="form-group">
    <?php
    $attributes = [];
    $attributes['class'] = 'form-control';
    if ($field === 'id') {
        $attributes[] = 'readonly';
        echo Form::label('id', 'ID');
        echo Form::text('id', $value, $attributes);
        echo '</div>';
        continue;
    }
    $fieldNo++;
    $attributes['id'] ="item_value_{$fieldNo}";
    ?>
    @if (is_array($value))
        {!! Form::label($field) !!}:
        <div style="margin-left:20px">
        @include('databags.modifyShowFields', ['item' => $value])
        </div>
    @else
        {!! Form::label($field, $field) !!}
        {!! Form::hidden('item_name[]', $field) !!}
         @if (strlen($value) > 120)
            {!! Form::textarea('item_value[]', $value, $attributes) !!}
         @else
            {!! Form::text('item_value[]', $value, $attributes) !!}
         @endif
    @endif
    </div>
@endforeach

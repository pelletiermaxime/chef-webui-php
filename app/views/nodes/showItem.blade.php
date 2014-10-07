<?php ksort($values) ?>
@foreach ($values as $index => $value)
    <?php
    $name = $index;
    if (isset($parent)) {
        $name = "[{$parent}][{$index}]";
    }
    ?>
    <li><span class="attribute-name">{{ $index }}</span>
    @if (is_object($value) || is_array($value))
        <ul>
        @include('nodes.showItem', ['values' => (array)$value, 'parent' => $name, 'attribute_name' => $attribute_name])
        </ul>
    @else
        @if (!empty($edit))
            {{ Form::text("{$attribute_name}{$name}", $value, ['class' => 'attribute']) }}
        @else
            <input disabled value="{{ $value }}" />
        @endif
    @endif
    </li>
@endforeach

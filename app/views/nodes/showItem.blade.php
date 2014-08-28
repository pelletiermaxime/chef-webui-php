<?php ksort($values) ?>
@foreach ($values as $index => $value)
    <li>{{ $index }}
    @if (is_object($value) || is_array($value))
        <ul>
        @include('nodes.showItem', ['values' => (array)$value, 'parent' => $index])
        </ul>
    @else
        :
        @if (!empty($edit))
            <?php
            $name = "{$parent}_{$index}";
            ?>
            {{ Form::text($name, $value, []) }}
        @else
            {{ $value }}
        @endif
    @endif
    </li>
@endforeach

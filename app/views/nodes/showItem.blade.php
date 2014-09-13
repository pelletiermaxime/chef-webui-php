<?php ksort($values) ?>
@foreach ($values as $index => $value)
    <?php
    $name = $index;
    if (isset($parent)) {
        $name = "{$parent}[{$index}]";
    }
    ?>
    <li><span class="attribute-name">{{ $index }}</span>
    @if (is_object($value) || is_array($value))
        <ul>
        @include('nodes.showItem', ['values' => (array)$value, 'parent' => $name])
        </ul>
    @else
        @if (!empty($edit))
            {{ Form::text($name, $value, ['class' => 'attribute']) }}
        @else
            {{ $value }}
        @endif
    @endif
    </li>
@endforeach

@foreach ($values as $index => $value)
    <li><?php echo($index)?>
    @if (is_object($value) || is_array($value))
        <ul>
        @include('nodes.showItem', array('values' => $value))
        </ul>
    @else
        : {{ $value }}
    @endif
    </li>
@endforeach

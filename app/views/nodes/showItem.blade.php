@foreach ($values as $index => $value)
    <li><?php echo($index)?>
    @if (is_object($value))
        <ul>
        @include('nodes.showItem', array('values' => $value))
        </ul>
    @endif
    </li>
@endforeach

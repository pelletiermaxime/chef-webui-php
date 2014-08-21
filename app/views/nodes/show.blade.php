@extends('_layouts.default')

@section('main')

@foreach ($node as $index => $value)
<div>
    <a data-toggle="collapse" href="#collapse-{{ $index }}">{{ $index }}</a>
</div>
<div id="collapse-{{ $index }}" class="collapse">
    <?php var_dump($value) ?>
</div>
@endforeach

@stop

@extends('_layouts.default')

@section('main')

<h2>{{ $node->name }}</h2>

Environment: {{ $node->chef_environment }}

<h3>Recipes</h3>
@foreach ($node->run_list as $run_list)
<div>
    {{ $run_list }}
</div>
@endforeach

<h3>Attributes</h3>

<b>Override:</b>
@foreach ($node->override as $index => $value)
<div>
    <a data-toggle="collapse" href="#collapse-override_{{ $index }}">{{ $index }}</a>
</div>
<div id="collapse-override_{{ $index }}" class="collapse">
    <?php var_dump($value) ?>
</div>
@endforeach

<b>Default:</b>
@foreach ($node->default as $index => $value)
<div>
    <a data-toggle="collapse" href="#collapse-{{ $index }}">{{ $index }}</a>
</div>
<div id="collapse-{{ $index }}" class="collapse">
    <?php var_dump($value) ?>
</div>
@endforeach

<b>Automatic:</b>
@foreach ($node->automatic as $index => $value)
<div>
    <a data-toggle="collapse" href="#collapse-{{ $index }}">{{ $index }}</a>
</div>
<div id="collapse-{{ $index }}" class="collapse">
    <?php var_dump($value) ?>
</div>
@endforeach

<b>Normal:</b>
@foreach ($node->normal as $index => $value)
<div>
    <a data-toggle="collapse" href="#collapse-{{ $index }}">{{ $index }}</a>
</div>
<div id="collapse-{{ $index }}" class="collapse">
    <?php var_dump($value) ?>
</div>
@endforeach

@stop

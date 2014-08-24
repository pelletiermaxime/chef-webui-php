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

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <a href="#collapse-override" data-toggle="collapse">
                <b>Override:</b>
            </a>
        </h3>
    </div>
    <div id="collapse-override" class="panel-collapse collapse in">
        <div class="panel-body" id="nodeOverride">
            <ul>
            @include('nodes.showItem', array('values' => $node->override))
            </ul>
        </div>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <a href="#collapse-default" data-toggle="collapse">
                <b>Default:</b>
            </a>
        </h3>
    </div>
    <div id="collapse-default" class="panel-collapse collapse in">
        <div class="panel-body" id="nodeDefault">
            <ul>
            @include('nodes.showItem', array('values' => $node->default))
            </ul>
        </div>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <a href="#collapse-default" data-toggle="collapse">
                <b>Automatic:</b>
            </a>
        </h3>
    </div>
    <div id="collapse-default" class="panel-collapse collapse in">
        <div class="panel-body" id="nodeAutomatic">
            <ul>
            @include('nodes.showItem', array('values' => $node->automatic))
            </ul>
        </div>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <a href="#collapse-default" data-toggle="collapse">
                <b>Normal:</b>
            </a>
        </h3>
    </div>
    <div id="collapse-default" class="panel-collapse collapse in">
        <div class="panel-body" id="nodeNormal">
            <ul>
            @include('nodes.showItem', array('values' => $node->normal))
            </ul>
        </div>
    </div>
</div>

@stop

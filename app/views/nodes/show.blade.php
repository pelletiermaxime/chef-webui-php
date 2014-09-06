@extends('_layouts.default')

@section('script')

<script>
$(function() {
    $('.jstree').jstree();
    $(".available_recipe").draggable({
        revert: "invalid",
        helper: "clone",
        cursor: "move"
    });
    $(".run_list, .available_recipes").droppable({
        drop: function( event, ui ) {
            ui.draggable.appendTo(this)
        }
    });
});
</script>

@stop

@section('main')

<h2>{{ $node->name }}</h2>

Environment: {{ $node->chef_environment }}

<h3>Recipes</h3>
<h4>Available recipes:</h4>
<div class="panel panel-primary">
    <ul class="available_recipes">
        @foreach ($available_cookbooks as $name => $cookbook)
        <li class="available_recipe">
            {{ $name }}
        </li>
        @endforeach
    </ul>
</div>

<br style="clear:both" />

<h4>Run list:</h4>
<div class="panel panel-primary">
    <ul class="run_list">
        @foreach ($node->run_list as $run_list)
        <li class="available_recipe">
            {{ $run_list }}
        </li>
        @endforeach
    </ul>
</div>

<h3>Attributes</h3>

{{ Form::open(['route' => ['nodes.store']]) }}

{{ Form::hidden('node_name', $node->name) }}

<div class="panel panel-primary">
    <div class="panel-heading">
        <div class="panel-title">
            <a href="#collapse-override" data-toggle="collapse">
                <b>Override:</b>
            </a>
            <button type="submit" class="btn btn-primary navbar-right" style="position: relative;top: -8px;">
                Save
            </button>
        </div>
    </div>
    <div id="collapse-override" class="panel-collapse collapse in">
        <div class="panel-body jstree">
            <ul>
            @include('nodes.showItem', ['values' => (array)$node->override, 'edit' => true])
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
        <div class="panel-body jstree">
            <ul>
            @include('nodes.showItem', ['values' => (array)$node->default, 'edit' => true])
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
        <div class="panel-body jstree">
            <ul>
            @include('nodes.showItem', ['values' => (array)$node->normal, 'edit' => true])
            </ul>
        </div>
    </div>
</div>
{{ Form::close() }}
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <a href="#collapse-default" data-toggle="collapse">
                <b>Automatic:</b>
            </a>
        </h3>
    </div>
    <div id="collapse-default" class="panel-collapse collapse in">
        <div class="panel-body jstree">
            <ul>
            @include('nodes.showItem', ['values' => (array)$node->automatic])
            </ul>
        </div>
    </div>
</div>

@stop

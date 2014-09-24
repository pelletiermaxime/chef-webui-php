@extends('_layouts.default')

@section('script')

<script>
function refreshRunList() {
    var cookbooks = ''
    $("#panel-available-run-list .run-list .available_recipe").each(function(index, el) {
        cookbooks += ' ' + $.trim($(el).text());
    });
    $('#run_list').val(cookbooks);
}

$(function() {
    $('.jstree').jstree({});
    $(document).on('click', '.jstree-leaf', function() {
        $(this).find('input').focus();
    });
    $(".available_recipe").draggable({
        revert: "invalid",
        helper: "clone",
        cursor: "move",
    });
    $("#panel-available-run-list").droppable({
        accept: ".available_recipes > li",
        drop: function( event, ui ) {
            ui.draggable.appendTo($(this).children('ul'));
            refreshRunList();
        },
        tolerance: "touch"
    });
    $("#panel-available-recipes").droppable({
        accept: ".run-list > li",
        drop: function( event, ui ) {
            ui.draggable.appendTo($(this).children('ul'));
            setTimeout(refreshRunList, 100);
        },
        tolerance: "touch"
    });

    var options = {
      valueNames: [ 'name' ]
    };

    var userList = new List('panel-available-recipes', options);
    });
</script>

@stop

@section('main')

<h2>{{ $node->name }}</h2>

Environment: {{ $node->chef_environment }}

<h3>Recipes</h3>
<h4 style="float:left">Available recipes:</h4>
<h4 style="float:right">Run list:</h4>

<br style="clear:both" />


<br style="clear:both" />

<div class="panel panel-primary" id="panel-available-recipes">
    <input class="search" placeholder="Search" />
    <ul class="available_recipes list">
        @foreach ($available_cookbooks as $cookbook)
        <li class="available_recipe">
            <p class="name">{{ $cookbook }}</p>
        </li>
        @endforeach
    </ul>
</div>


<div class="panel panel-primary" id="panel-available-run-list">
    <ul class="run-list">
        @foreach ($node->run_list['recipe'] as $cookbook)
        <li class="available_recipe">
            {{ $cookbook }}
        </li>
        @endforeach
    </ul>
</div>

{{ Form::open(['route' => ['nodes.store']]) }}

<div>
<button type="submit" class="btn btn-primary" style="float: right;">
    Save node
</button>
</div>

<br style="clear:both" />

<h3>Attributes</h3>

{{ Form::hidden('node_name', $node->name) }}
{{ Form::hidden('run_list', implode(' ', $node->run_list['recipe']), ['id' => 'run_list']) }}

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

@extends('_layouts.default')

@section('main')
{{ Form::model($item, array('route' => 'databags.store')) }}

    <h1>Edit databag item <b>{{ $info['item_name'] }}</b></h1>

    {{ Form::hidden('item_name', $info['item_name']) }}
    {{ Form::hidden('databag_item', $info['databag_name']) }}
    {{ Form::hidden('action', 'modify') }}

    <?php $fieldNo = 0 ?>
    @include('databags.modifyShowFields')

    @include('databags.addFields')

    {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
{{Form::close()}}
@stop


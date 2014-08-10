@extends('_layouts.default')

@section('main')
@include('_layouts.messages')

<a href="{{ route('databags.create') }}">
<!-- <button type="submit" class="btn btn-primary btn-lg">Create</button> -->
</a>

<table class="table">
<thead>
<tr>
    <th>Id</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
</tr>
</thead>
<tbody>
@foreach ($databags as $id => $url)
<tr>
    <td>
        @if ($data_item === '')
        <a href="{{ route('databags.show', $id) }}">{{ $id }}</a>
        @else
        <a href="{{ route('databags.editItem', [$data_item, $id]) }}">{{ $id }}</a>
        @endif
    </td>
    <td>
        <a href="{{ route('databags.show', $id) }}">Edit</a>
    </td>
    <td>
        <a href="{{ route('databags.destroy', $id) }}">Delete</a>
    </td>
</tr>
@endforeach
</tbody>
</table>

@stop

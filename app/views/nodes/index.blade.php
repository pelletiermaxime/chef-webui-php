@extends('_layouts.default')

@section('main')

<a href="{{ route('nodes.create') }}">
<button type="submit" class="btn btn-primary btn-lg">Create</button>
</a>

<table class="table">
<thead>
@if (count($nodes))
<tr>
    <th>Id</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
</tr>
@endif
</thead>
<tbody>
@forelse ($nodes as $name => $url)
<tr>
    <td>
        <a href="{{ route('nodes.show', $name) }}">{{ $name }}</a>
    </td>
    <td>
        <a href="{{ route('nodes.show', $name) }}">Edit</a>
    </td>
    <td>
        <a href="{{ route('nodes.destroy', $name) }}">Delete</a>
    </td>
</tr>
@empty
<tr>
    <td>No nodes</td>
</tr>
@endforelse
</tbody>
</table>

@stop

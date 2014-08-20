@extends('_layouts.default')

@section('main')

<!-- <a href="{{ route('databags.create') }}">
<button type="submit" class="btn btn-primary btn-lg">Create</button>
</a> -->

<table class="table">
<thead>
<tr>
    <th>Id</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
</tr>
</thead>
<tbody>
@foreach ($nodes as $name => $url)
<tr>
    <td>
        <a href="{{ route('nodes.show', $name) }}">{{ $name }}</a>
    </td>
    <td>
        <a href="{{ route('nodes.edit', $name) }}">Edit</a>
    </td>
    <td>
        <a href="{{ route('nodes.destroy', $name) }}">Delete</a>
    </td>
</tr>
@endforeach
</tbody>
</table>

@stop

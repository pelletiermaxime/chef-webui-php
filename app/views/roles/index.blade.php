@extends('_layouts.default')

@section('main')

<a href="{{ route('roles.create') }}">
<button type="submit" class="btn btn-primary btn-lg">Create</button>
</a>

<table class="table">
<thead>
@if (count($roles))
<tr>
    <th>Id</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
</tr>
@endif
</thead>
<tbody>
@forelse ($roles as $name => $url)
<tr>
    <td>
        <a href="{{ route('roles.show', $name) }}">{{ $name }}</a>
    </td>
    <td>
        <a href="{{ route('roles.show', $name) }}">Edit</a>
    </td>
    <td>
        <a href="{{ route('roles.destroy', $name) }}">Delete</a>
    </td>
</tr>
@empty
<tr>
    <td>No roles</td>
</tr>
@endforelse
</tbody>
</table>

@stop

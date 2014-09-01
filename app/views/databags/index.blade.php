@extends('_layouts.default')

@section('main')

<a href="{{ route('databags.create', $data_item) }}">
<button type="submit" class="btn btn-primary btn-lg">Create</button>
</a>

<table class="table">
<thead>
@if (count($databags))
<tr>
    <th>Id</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
</tr>
@endif
</thead>
<tbody>
@forelse ($databags as $id => $url)
<tr>
    <td>
        @if ($data_item === '')
        <a href="{{ route('databags.show', $id) }}">{{ $id }}</a>
        @else
        <a href="{{ route('databags.editItem', [$data_item, $id]) }}">{{ $id }}</a>
        @endif
    </td>
    <td>
        @if ($data_item === '')
        <a href="{{ route('databags.show', $id) }}">Edit</a>
        @else
        <a href="{{ route('databags.editItem', [$data_item, $id]) }}">Edit</a>
        @endif
    </td>
    <td>
        @if ($data_item === '')
        <a href="{{ route('databags.destroy', $id) }}">Delete</a>
        @else
        <a href="{{ route('databags.destroyItem', [$data_item, $id]) }}">Delete</a>
        @endif
    </td>
</tr>
@empty
<tr>
    <td>No databags</td>
</tr>
@endforelse
</tbody>
</table>

@stop

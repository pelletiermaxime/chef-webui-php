@extends('_layouts.default')

@section('main')

<table class="table">
<thead>
@if (count($cookbooks))
<tr>
    <th>Name</th>
    <th>Versions</th>
</tr>
@endif
</thead>
<tbody>
@forelse ($cookbooks as $name => $cookbook)
<tr>
    <td>
        {{ $name }}
    </td>
    <td>
        {{ $cookbook->versions[0]->version }}
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

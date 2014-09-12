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
        @foreach ((array) $cookbook->versions as $version)
            {{ $version->version }}<br />
        @endforeach
    </td>
</tr>
@empty
<tr>
    <td>No cookbooks</td>
</tr>
@endforelse
</tbody>
</table>

@stop

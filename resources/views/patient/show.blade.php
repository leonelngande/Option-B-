@extends('layouts.app')

@section('head_title', 'View Patient |' )

@section('content')

<ul class="list-group">
    @foreach($patient as $detail)
        <li class="list-group-item">
            <span class="badge">14</span>
            {{ $detail }}
        </li>
    @endforeach
</ul>

@endsection


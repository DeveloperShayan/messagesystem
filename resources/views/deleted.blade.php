@extends('layouts.app')

@section('content')
@if (count($messages) > 0)
<ul class="list-group overflow-auto">
    <h3>Deleted Messages </h3>
    @foreach ($messages as $message)
            <li class="list-group-item">
                <strong>From {{ $message->userFrom->name }}</strong> | {{ $message->subject }}
                <a href="{{ route('return',$message->id) }}" class="btn btn-info float-end btn-sm">Return message to inbox</a> 
            </li>
        </a> 
    @endforeach
</ul>

@else
<h3>No Messages</h3>
@endif

@endsection
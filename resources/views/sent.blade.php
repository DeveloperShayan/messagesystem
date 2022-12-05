@extends('layouts.app')

@section('content')

<h3>Sent To</h3>
@if (count($messages) > 0)
<ul class="list-group">
    @foreach ($messages as $message)
        <li class="list-group-item"><strong>To {{ $message->userTo->name }}</strong> | {{ $message->subject }}
            @if ($message->read)
            <span class="badge bg-success float-end">Read</span>
            @endif
        </li>
        <hr>            
    @endforeach
    
</ul>

@else
<h3>No Messages sent</h3>
@endif


@endsection
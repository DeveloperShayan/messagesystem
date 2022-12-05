@extends('layouts.app')

@section('content')
    @if (count($messages) > 0)
        <ul class="list-group overflow-auto">
            @foreach ($messages as $message)
                <a href="{{ route('read',$message->id) }}" class="text-decoration-none">
                    <li class="list-group-item">
                        <strong>From {{ $message->userFrom->name }}</strong> | {{ $message->subject }} 
                    </li>
                </a> 
                <br>
            @endforeach
        </ul>
        
    @else
        <h3>No Messages</h3>
    @endif

@endsection

@extends('layouts.app')

@section('content')
    From : {{ $message->userFrom->name }}
    <br>
    Email : {{ $message->userFrom->email }}
    <br>
    Subject : {{ $message->subject }}
    <br>
    Message : 
    <br>
    {{ $message->body }}
    <hr>
    <a href="{{ route('create', [$message->userFrom->id, $message->subject]) }}" class="btn btn-primary">Reply</a>
    <a href="{{ route('delete', [$message->id, $message->subject]) }}" class="btn btn-danger">Delete</a>
@endsection
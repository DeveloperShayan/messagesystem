@extends('layouts.app')

@section('content')
    <form action="{{ route('store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="To">To</label>
            <select name="to" id="to" class="form-control">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} , {{ $user->email }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="subject">Subject</label>
            <input id="subject" class="form-control" type="text" name="subject" value="{{ $subject }}">
        </div>

        <div class="form-group">
            <label for="message">Message</label>
            <textarea name="body" id="body" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <br>
        <button type="submit" class="form-control btn btn-primary btn-block">SEND</button>

    </form>
@endsection
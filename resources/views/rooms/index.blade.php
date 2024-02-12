@extends('layouts.main')
@section('content') 

     Комнаты<br>

     <a class="btn btn-success mb-3 mt-3" href="{{ route('room.create') }}">Add room</a>
    

     @foreach($rooms as $room)
     <div><a href="{{ route('room.show', $room->id) }}"> {{$room->id}}.  {{$room->title}} </a> -  <a href="{{ route('room.edit', $room->id) }}">Edit</a>
          <form action="{{ route('room.destroy', $room->id) }}" method="post">
               @csrf
               @method('delete')
          - <button type="submit">Delete</button>
          </form>
     @endforeach

    


@endsection
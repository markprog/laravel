@extends('layouts.main')
@section('content') 

     Комнаты<br>

     @foreach($rooms as $room)
     <div>{{$room->id}} . {{$room->title}}</div>


     @endforeach

    


@endsection
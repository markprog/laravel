@extends('layouts.main')
@section('content') 

     Комнаты<br>

     <div class="table-responsive small" bis_skin_checked="1">
        <table class="table table-striped table-sm text-center">
          <thead>
            <tr>
              
              <th scope="col">id</th>
              <th scope="col">title</th>
              <th scope="col">persons</th>
              <th scope="col">likes</th>
              <th scope="col">width</th>
              <th scope="col">length</th>

            </tr>
          </thead>
          <tbody>
            @foreach ($rooms as $room)
            <tr>
 
              <td>{{$room->id}}</td>
              <td>{{$room->title}}</td>
              <td>{{$room->persons}}</td>
              <td>{{$room->likes}}</td>
              <td>{{$room->width}}</td>
              <td>{{$room->length}}</td>

            </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>

    


@endsection
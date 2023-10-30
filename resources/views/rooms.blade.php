@extends('layouts.main')
@section('content') 

     Комнаты<br>

     <div class="table-responsive small" bis_skin_checked="1">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">id</th>
              <th scope="col">title</th>
              <th scope="col">persons</th>
              <th scope="col">name</th>
              <th scope="col">email</th>
            </tr>
          </thead>
          <tbody>
            <tr>
               <td>{{$room-id}}</td>
              <td>{{$room->title}}</td>
              <td>{{$room->persons}}</td>
              
              <td>{{$room->name}}</td>
              <td>{{$room->email}}</td>
            </tr>
            
          </tbody>
        </table>
      </div>

    


@endsection
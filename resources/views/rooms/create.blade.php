@extends('layouts.main')
@section('content') 

<div class="container">
     <h3>Создание комнаты</h3>
     
     <form class="col-6" action="{{ route('rooms.store') }}" method="post">
          @csrf
  <div class="form-group">
    <label for="created_at">created_at</label>
    <input type="text" class="form-control" name="created_at" placeholder="created_at">
  </div>

  <div class="form-group">
    <label for="updated_at">updated_at</label>
    <input type="text" class="form-control" name="updated_at" placeholder="updated_at">
  </div>

  <div class="form-group">
    <label for="width">width</label>
    <input type="number" class="form-control" name="width" placeholder="width">
  </div>

  <div class="form-group">
    <label for="length">length</label>
    <input type="number" class="form-control" name="length" placeholder="length">
  </div>

  <div class="form-group">
    <label for="likes">likes</label>
    <input type="number" class="form-control" name="likes" placeholder="likes">
  </div>

  <div class="form-group">
    <label for="is_published">is_published</label>
    <input type="text" class="form-control" name="is_published" placeholder="is_published">
  </div>

  <div class="form-group">
    <label for="persons">persons</label>
    <input type="number" class="form-control" name="persons" placeholder="persons">
  </div>
  
  <button type="submit" class="btn btn-primary mb-2">Create</button>
     </form>
     </div>
    

    

    


@endsection
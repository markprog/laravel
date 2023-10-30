@extends('layouts.main')
@section('content') 

<form class="needs-validation" novalidate="" action="{{ route('room.store') }}" method="post">

  @csrf
  <div class="row g-3 col-6">
    <div class="form-group">
      <label for="title" class="form-label">title</label>
      <input type="text" class="form-control" name="title" placeholder="" value="title" required="">
    </div>

    <div class="form-group">
      <label for="persons" class="form-label">persons</label>
      <input type="number" class="form-control" name="persons" placeholder="" value="persons" required="">
    </div>

    <div class="form-group">
      <label for="width" class="form-label">width</label>
      <input type="number" class="form-control" name="width" placeholder="" value="width" required="">
    </div>

    <div class="form-group">
      <label for="length" class="form-label">length</label>
      <input type="number" class="form-control" name="length" placeholder="" value="length" required="">
    </div>

  </div>

  <button class="w-100 btn btn-primary btn-lg" type="submit">Submit</button>
</form>

    

    


@endsection
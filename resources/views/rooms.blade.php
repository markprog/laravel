<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    HTML Document

    @foreach($rooms as $room)
       <h4> Комната: {{$room->title}}<br>  Вместимость: {{$room->persons}} человек. </h4> 
    @endforeach
</body>
</html>

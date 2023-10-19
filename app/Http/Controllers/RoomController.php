<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;


class RoomController extends Controller
{   
    
    
    public function index(){
        
        // $kitchen = Room::find(1);
        // //dd($string);
    
        // var_dump($kitchen->title);
        // dd($kitchen);
        // return $kitchen;

        // $rooms = Room::all();
        // //dump($rooms);
        // dd($rooms);

        $rooms = Room::all(); // Получаем все записи из таблицы posts

        foreach ($rooms as $room) {
        // Ваш код для обработки каждой записи $post
        echo $room->title . ' - ' . $room->width . ' на ' . $room->length . '<br>';
        }

        


    }

    public $i;

    public function create(){

        $roomsArr = [
            [
            
            'title' =>'Title 8',
            'width' =>'4',
            'length' =>'2',
            'likes' =>'100',
            'persons' =>'2'
            ]
            ,
            [
                
                'title' =>'Title 9',
                'width' =>'9',
                'length' =>'6',
                'likes' =>'700',
                'persons' =>'2'
                ]
            
        ];

       foreach ($roomsArr as $room) {
            Room::create($room);
       }

    

       
       
        while ($this->i <= 100) { // Замените 10 на количество итераций, которое вам нужно
            Room::create([
                'title' => 'Title ' . $this->i,
                'width' => '4',
                'length' => '2',
                'likes' => '100',
                'persons' => '2'
            ]);
        
            $this->i++; // Увеличиваем i для следующей итерации
        }

    }

        public function update()
        {
            $room = Room::find(8);
            dd($room->title); 
            

            $room->update([
                'title' => 'Updated Title',
                'width' => '4',
                'length' => '2',
                'likes' => '100',
                'persons' => '2'
            ]);

            dd('updated'); 
            

        }

        public function delete()
        {
           
            $room = Room::where('persons', 2);
            
            

            $room->delete();

            dd('Deleted'); 
            

        }


}
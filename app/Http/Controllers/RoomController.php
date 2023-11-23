<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;


class RoomController extends Controller
{   
    
    
    public function index(){
  

        $rooms = Room::all(); // Получаем все записи из таблицы posts
        return view('rooms.index', compact('rooms'));
       
    }

    public $i;

    public function create(){

    //    foreach ($roomsArr as $room) {
    //         Room::create($room);
    //    }

    return view('rooms.create');

    }

    public function store(){
    
        dd('111111111');
    
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


        public function firstOrCreate(){
           
            // $room = Room::find(8);
            // dd($room->title);

            // $anotherRoom = [
            //     'title' => 'Another Title ',
            //     'width' => '5',
            //     'length' => '2',
            //     'likes' => '10000',
            //     'persons' => '3'
            // ];

                $room = Room::firstOrCreate(
                [
                    'title' => 'title 200'
                ],
                [
                    'title' => 'Another Title ',
                'width' => '5',
                'length' => '2',
                'likes' => '10000',
                'persons' => '3'
                ]



                );

                dd($room->title . ' ' . $room->width . ' ' . $room->persons);
                
                dd('finished');

        }


        public function updateOrCreate(){
           
            // $room = Room::find(8);
            // dd($room->title);

            // $anotherRoom = [
            //     'title' => 'Another Title ',
            //     'width' => '5',
            //     'length' => '2',
            //     'likes' => '10000',
            //     'persons' => '3'
            // ];

                $room = Room::updateOrCreate(
                [
                    'title' => 'Title 90' 
                ],
                [
                'title' => 'title 2000',
                'width' => '55',
                'length' => '20',
                'likes' => '1',
                'persons' => '30'
                ]



                );

                dd($room->title . ' ' . $room->width . ' ' . $room->persons);
                
                dd('finished');

        }


}

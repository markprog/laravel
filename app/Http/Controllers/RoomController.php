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
        
        $data = request()->validate([
            'title' => 'string',
            'width' => '',
            'length' => '',
            'likes' => '',
            'persons' => ''

        ]);

        Room::create($data);
        return redirect()->route('room.index');
    
        }

        public function show(Room $room){
            
            //$room = Room::findOrFail($id);
            //dd($room->title);
            return view('rooms.show',  compact('room'));
        
            }

        public function edit(Room $room){
            
                //$room = Room::findOrFail($id);
                //dd($room->title);
                return view('rooms.edit',  compact('room'));
            
        }

        public function update(Room $room){
            
            //$room = Room::findOrFail($id);
            //dd($room->title);
            $data = request()->validate([
                'title' => 'string',
                'width' => '',
                'length' => '',
                'likes' => '',
                'persons' => ''
    
            ]);
            $room->update($data);
            return redirect()->route('room.index');

            //Room::update($data);
            //return redirect()->route('room.index');

        
        }
    

        public function destroy(Room $room)
        {
            $room->delete();
            return redirect()->route('room.index');
            
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

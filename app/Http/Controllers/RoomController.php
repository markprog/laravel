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
        return view('rooms.index', compact('rooms'));
        // foreach ($rooms as $room) {
        // // Ваш код для обработки каждой записи $post
        // echo $room->title . ' - ' . $room->width . ' на ' . $room->length . '<br>';
        // }

       
    }

    public $i;

    public function create(){

        return view('rooms.create');
 
       }


    public function store(){
        $data = request()->validate([
            'title' => 'string|nullable',
            'persons' => 'integer|nullable',
            'width' => 'integer|nullable',
            'length' => 'integer|nullable'
        ]);

        var_dump($data);
    }
    

       
       
        // while ($this->i <= 100) { // Замените 10 на количество итераций, которое вам нужно
        //     Room::create([
        //         'title' => 'Title ' . $this->i,
        //         'width' => '4',
        //         'length' => '2',
        //         'likes' => '100',
        //         'persons' => '2'
        //     ]);
        
        //     $this->i++; // Увеличиваем i для следующей итерации
        // }

    

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

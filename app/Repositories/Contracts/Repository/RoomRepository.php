<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Room;
use App\Repositories\Contracts\RepositoryInterface\RoomRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\Hotel;

class RoomRepository extends BaseRepository implements RoomRepositoryInterface
{
    public function getModel()
    {
        return Room::class;
    }

    /**
     * @param integer $id
     * 
     * @return object
     */
    public function findByHotel(int $id) : object
    {
        $rooms = Room::where('hotel_id', $id)->get();   //lấy ra room theo hotel 

        return $rooms; //trả về room
    }

    /**
     * @param array $request
     * 
     * @return void
     */
    public function searchRoom($request = [])
    {
        $dates = array(); 
        
        if ($request['end'] == null) { //nếu enddate = null => startdate = enddate
            $start = $request['start']; //gán
            $end = $request['start'];
        } else {
            $start = strtotime($request['start']);  
            $end = strtotime($request['end']);
        }

        if ($end < $start) {
            $start = strtotime($request['end']);  //strtotime => convert time string về dạng timestamp
            $end = strtotime($request['start']);
        } 
        // dd($start);
        for ($currentDate = $start; $currentDate <= $end; $currentDate += (86400)) {  //for($i = startdate; $i <= enddate; $i + 1 ngày)
            $dates[] = $currentDate;
        }
        $rooms = [];

        foreach ($dates as $date) {
            $start = strtotime($request['start']);
            $query = Room::select('rooms.*')
            ->leftJoin('amounts', 'rooms.id', '=', 'amounts.room_id')
            ->leftJoin('availabilities', 'rooms.id', '=', 'availabilities.room_id')
            ->where('amounts.day', '=', $date)
            ->where('availabilities.day', '=', $date)
            ;
            if($request['hotel']) {
                $hotel_id = Hotel::where('name', 'like', '%'.$request['hotel'].'%')->first();
                $query->where('hotel_id', $hotel_id->id);
            } elseif ($request['room']) {
                $query->where('rooms.name', 'like', '%'.$request['room'].'%');
            } elseif ($request['min'] && $request['max']) {
                $query->whereBetween('amounts.price', [$request['min'], $request['max']]);
            }

            $rooms[] = $query->groupBy('rooms.id')->get();
        }

        return $rooms;
    }
}

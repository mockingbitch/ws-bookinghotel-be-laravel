<?php 
namespace App\Services;
use App\Repositories\Contracts\RepositoryInterface\AvailabilityRepositoryInterface;

class AvailabilityService
{
    /**
     * @var @avaiRepository
     */
    private $avaiRepository;

    /**
     * @param AvailabilityRepository $avaiRepository
     */
    public function __construct(AvailabilityRepositoryInterface $avaiRepository )
    {
        $this->avaiRepository = $avaiRepository;
    }

    /**
     * @param integer $room_id
     * @param array $request
     * 
     * @return void
     */
    public function createAvailability(int $room_id, array $request)  //tương tự amount
    {
        $data = array();
        $dates = array();
        
        if ($request['end_date'] == null) {
            $start = $request['start_date'];
            $end = $request['start_date'];
        } elseif ($request['start_date'] < $request['end_date']) {
            $start = strtotime($request['start_date']);
            $end = strtotime($request['end_date']);
        } else {
            $end = strtotime($request['start_date']);
            $start = strtotime($request['end_date']);
        }

        for ($currentDate = $start; $currentDate <= $end; $currentDate += (86400)) {
            $store = date('Y-m-d', $currentDate);
            $dates[] = $store;
        }

        foreach ($dates as $date) {
            $availability = $this->avaiRepository->findByDay($room_id, $date);
            
            if (isset($availability) && count($availability) > 0) {
                return $res = [
                    'errCode' => 1,
                    'msg' => 'Already exists'
                ];
            } else {
                $data = [
                    'room_id' => $room_id,
                    'stock' => $request['stock'],
                    'day' => strtotime($date)
                ];
            
                $this->avaiRepository->create($data);

                return $res = [
                    'errCode' => 0,
                    'msg' => 'success'
                ];
            }
        }
    }
}
<?php 
namespace App\Services;
use App\Repositories\Contracts\RepositoryInterface\AmountRepositoryInterface;

class AmountService
{
    /**
     * @var @amountRepository
     */
    private $amountRepository;

    /**
     * @param AmountRepository $amountRepository
     */
    public function __construct(AmountRepositoryInterface $amountRepository )  
    {
        $this->amountRepository = $amountRepository;
    }

    /**
     * @param integer $room_id
     * @param array $request
     * 
     * @return void
     */
    public function createAmount(int $room_id, array $request) 
    {
        $data = array(); //tạo array  = null 
        $dates = array(); 
        
        if ($request['end_date'] == null) { //nếu enddate = null => startdate = enddate
            $start = $request['start_date']; //gán
            $end = $request['start_date'];
        } elseif ($request['start_date'] < $request['end_date']) { //check startdate và enddate nhập đúng hay sai
            $start = strtotime($request['start_date']);  //strtotime => convert time string về dạng timestamp
            $end = strtotime($request['end_date']);
        } else {
            $end = strtotime($request['start_date']);
            $start = strtotime($request['end_date']);
        }

        for ($currentDate = $start; $currentDate <= $end; $currentDate += (86400)) {  //for($i = startdate; $i <= enddate; $i + 1 ngày)
            $store = date('Y-m-d', $currentDate);//lấy ra mảng data dates 
            $dates[] = $store;
        }

        foreach ($dates as $date) {
            $amount = $this->amountRepository->findByDay($room_id, $date); //lấy ra amount theo ngày
            
            if (isset($amount) && count($amount) > 0) { //check tồn tại trong db
                return $res = [
                    'errCode' => 1,
                    'msg' => 'Already exists'
                ];
            } else {
                $data = [
                    'room_id' => $room_id,
                    'price' => $request['price'],
                    'day' => strtotime($date)
                ];
            
                $this->amountRepository->create($data); //hàm tạo amount 

                return $res = [
                    'errCode' => 0,
                    'msg' => 'success'
                ];
            }
        }
    }
}
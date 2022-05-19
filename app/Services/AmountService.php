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
            $amount = $this->amountRepository->findByDay($room_id, strtotime($date));
            
            if (isset($amountlability) && count($amountlability) > 0) {
                return false;
            } else {
                $data = [
                    'room_id' => $room_id,
                    'price' => $request['price'],
                    'day' => strtotime($date)
                ];
            
                $this->amountRepository->create($data);
            }
        }

        return true;
    }
}
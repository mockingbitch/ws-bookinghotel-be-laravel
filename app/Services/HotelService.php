<?php

namespace App\Services;

use App\Models\Hotel;
use App\Repositories\Contracts\RepositoryInterface\HotelRepositoryInterface;

class HotelService
{
    /**
     * @var @hotelRepository
     */
    protected $hotelRepository;

    /**
     * @param HotelRepositoryInterface $hotelRepository
     */
    public function __construct(HotelRepositoryInterface $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;
    }

    /**
     * @param array $request
     * 
     * @return void
     */
    public function create(array $request)
    {
        if(isset($request['image'])) {
            $request['image'] = $this->imageProcessing($request['image']);
        }
        
        $hotel=$this->hotelRepository->create($request);
    }

    /**
     * @param integer $id
     * @param $request
     * 
     * @return void
     */
    public function update(int $id, $request)
    {
        dd($request->name);
        $data = [
            'name' => $request->name,
            'city' => $request->city,
            'hotline' => $request->hotline,
            'description'=> $request->description,
        ];

        if(isset($request['image'])) {
            if ($request->hasFile('image')) {
                $data['image'] = $this->imageProcessing($request->image);
            }
        }

        $updateHotel = $this->hotelRepository->update($id, $data);
    }

    /**
     * @param [type] $file
     * @return void
     */
    public function imageProcessing($file)
    {
        $image = uniqid('', true) . $file->getClientOriginalName();
        $file->move('uploads/hotels', $image);

        return $image;
    }
}

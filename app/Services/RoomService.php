<?php

namespace App\Services;

use App\Repositories\Contracts\RepositoryInterface\RoomRepositoryInterface;

class RoomService
{
    /**
     * @var @roomRepository
     */
    protected $roomRepository;

    /**
     * @param RoomRepositoryInterface $roomRepository
     */
    public function __construct(RoomRepositoryInterface $roomRepository)
    {
        $this->roomRepository = $roomRepository;
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
        
        $room=$this->roomRepository->create($request);
    }

    /**
     * @param integer $id
     * @param array $request
     * 
     * @return void
     */
    public function update(int $id, $request)
    {
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

        $updateRoom = $this->roomRepository->update($id, $data);
    }

    /**
     * @param [type] $file
     * @return void
     */
    public function imageProcessing($file)
    {
        $image = uniqid('', true) . $file->getClientOriginalName();
        $file->move('uploads/rooms', $image);

        return $image;
    }
}

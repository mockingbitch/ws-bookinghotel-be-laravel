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
            $request['image'] = $this->imageProcessing($request['image']); //xử lý hình ảnh
        }
        
        $room=$this->roomRepository->create($request); //gọi đến hàm tạo từ RoomRepository
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
                $data['image'] = $this->imageProcessing($request->image); //xử lý hình ảnh
            }
        }

        $updateRoom = $this->roomRepository->update($id, $data); //gọi đến hàm update ở trong roomRepository
    }

    /**
     * @param [type] $file
     * @return void
     */
    public function imageProcessing($file) //hàm xử lý ảnh
    {
        $image = uniqid('', true) . $file->getClientOriginalName();
        $file->move('uploads/rooms', $image);

        return $image;
    }
}

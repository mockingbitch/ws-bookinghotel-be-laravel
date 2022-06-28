<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\BookingDetail;
use App\Repositories\Contracts\RepositoryInterface\BookingDetailRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\User;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Hotel;

class BookingDetailRepository extends BaseRepository implements BookingDetailRepositoryInterface
{
    public function getModel()
    {
        return BookingDetail::class;
    }

    public function getBookingDetail(int $id)
    {   
        $bookingDetail = BookingDetail::where('booking_id', $id)->first();
        $booking = Booking::where('id', $id)->first();
        $guest_name = User::select('name')->where('id', $booking->guest_id)->first();
        $admin_name = User::select('name')->where('id', $booking->admin_id)->first();
        $room_name = Room::select('name')->where('id', $bookingDetail->room_id)->first();
        $hotel_id = Room::select('hotel_id')->where('id', $bookingDetail->room_id)->first();
        $hotel_name = Hotel::select('name')->where('id', $hotel_id->hotel_id)->first();
        $data = [
            'guest_name' => $guest_name->name,
            'admin_name' => $admin_name->name,
            'hotel_name' => $hotel_name->name,
            'room_name' => $room_name->name,
            'start_date' => $bookingDetail->start_date,
            'end_date' => $bookingDetail->end_date
        ];

        return $data;
    }
}

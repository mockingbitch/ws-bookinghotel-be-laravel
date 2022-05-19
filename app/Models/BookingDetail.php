<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;

class BookingDetail extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'bookingdetails';

    /**
     * @var array
     */
    protected $fillable = [
        'room_id',
        'booking_id',
        'start_date',
        'end_date',
        'members',
        'total'
    ];

    /**
     * @return void
     */
    public function room() {
        return $this->belongsTo(Room::class, 'room_id');
    }

    /**
     * @return void
     */
    public function booking() {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}

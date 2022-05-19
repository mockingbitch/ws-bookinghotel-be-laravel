<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;

class Availability extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'availabilities';

    /**
     * @var array
     */
    protected $fillable = [
        'room_id',
        'stock',
        'day'
    ];

    /**
     * @return void
     */
    public function room() {
        return $this->belongsTo(Room::class, 'room_id');
    }
}

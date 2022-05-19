<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room; 

class Amount extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'amounts';

    /**
     * @var array
     */
    protected $fillable = [
        'room_id',
        'price',
        'day'
    ];

    /**
     * @return void
     */
    public function room() {
        return $this->belongsTo(Room::class, 'room_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hotel;

class Room extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'rooms';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'hotel_id',
        'image',
        'type',
        'description',
        'allstock'
    ];

    /**
     * @return void
     */
    public function hotel() {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
}

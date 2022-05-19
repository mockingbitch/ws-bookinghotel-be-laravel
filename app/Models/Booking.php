<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Booking extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'bookings';

    /**
     * @var array
     */
    protected $fillable = [
        'guest_id',
        'admin_id',
        'date',
        'guest_name',
        'guest_email',
        'guest_phone',
        'note',
        'total',
        'status'
    ];

    /**
     * @return void
     */
    public function guest() {
        return $this->belongsTo(User::class, 'guest_id');
    }

    /**
     * @return void
     */
    public function admin() {
        return $this->belongsTo(User::class, 'admin_id');
    }
}

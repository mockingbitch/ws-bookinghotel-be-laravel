<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'hotels';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'city_id',
        'address',
        'image',
        'hotline',
        'description',
    ];
}

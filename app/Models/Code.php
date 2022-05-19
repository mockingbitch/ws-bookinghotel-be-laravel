<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'codes';

    /**
     * @var array
     */
    protected $fillable = [
        'key',
        'type',
        'value_vi',
        'value_en'
    ];
}

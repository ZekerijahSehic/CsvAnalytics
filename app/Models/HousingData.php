<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class HousingData
 */
class HousingData extends Model
{

    /**
     * @var string[]
     */
    protected $fillable = [
        'date',
        'area',
        'average_price',
        'code',
        'houses_sold',
        'no_of_crimes',
        'borough_flag',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'date' => 'date',
        'borough_flag' => 'boolean',
    ];
}

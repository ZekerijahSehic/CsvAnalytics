<?php

namespace Tests\Feature\Helpers;

/**
 * Class HousingStatsHelper
 */
class HousingStatsHelper
{

    public static function getExpectedJsonStructure(): array
    {
        return [
            'data' => [
                'avg_price',
                'total_houses_sold',
                'crimes_2011',
                'london_avg_price_per_year',
            ],
        ];
    }
}

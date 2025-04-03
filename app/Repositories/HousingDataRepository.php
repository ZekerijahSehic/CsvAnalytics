<?php

namespace App\Repositories;

use App\Models\HousingData;
use Illuminate\Support\Collection;


/**
 * Class HousingDataRepository
 */
class HousingDataRepository
{

    /**
     * @param Collection $dtos
     * @return void
     */
    public function bulkInsert(Collection $dtos): void
    {
        $chunks = $dtos->map->toArray()->chunk(500);
        foreach ($chunks as $chunk) {
            HousingData::insert($chunk->all());
        }
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class HousingStatsResource
 */
class HousingStatsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'avg_price' => round($this->getAvgPrice()),
            'total_houses_sold' => $this->getTotalSold(),
            'crimes_2011' => $this->getCrimes2011(),
            'london_avg_price_per_year' => (object) $this->getLondonAvgPricePerYear(),
        ];
    }
}

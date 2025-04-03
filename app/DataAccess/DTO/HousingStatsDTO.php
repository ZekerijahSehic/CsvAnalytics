<?php

namespace App\DataAccess\DTO;

/**
 * Class HousingStatsDTO
 */
class HousingStatsDTO
{

    /**
     * @param float|null $avgPrice
     * @param int|null $totalSold
     * @param int|null $crimes2011
     * @param array|null $londonAvgPricePerYear
     */
    public function __construct(
        public ?float $avgPrice,
        public ?int $totalSold,
        public ?int $crimes2011,
        public ?array $londonAvgPricePerYear
    ) {}

    /**
     * @return float
     */
    public function getAvgPrice(): float
    {
        return $this->avgPrice;
    }

    /**
     * @return int
     */
    public function getTotalSold(): int
    {
        return $this->totalSold;
    }

    /**
     * @return int
     */
    public function getCrimes2011(): int
    {
        return $this->crimes2011;
    }

    /**
     * @return array
     */
    public function getLondonAvgPricePerYear(): array
    {
        return $this->londonAvgPricePerYear;
    }
}

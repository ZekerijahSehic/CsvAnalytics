<?php

namespace App\DataAccess\DTO;

/**
 * Class HousingDataDTO
 */
class HousingDataDTO
{

    /**
     * @param string|null $date
     * @param string|null $area
     * @param int|null $average_price
     * @param string|null $code
     * @param int|null $houses_sold
     * @param float|null $no_of_crimes
     * @param bool|null $borough_flag
     */
    public function __construct(
        public ?string $date,
        public ?string $area,
        public ?int $average_price,
        public ?string $code,
        public ?int $houses_sold,
        public ?float $no_of_crimes,
        public ?bool $borough_flag,
    ) {}

    /**
     * @return string|null
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * @return string|null
     */
    public function getArea(): ?string
    {
        return $this->area;
    }

    /**
     * @return int|null
     */
    public function getAveragePrice(): ?int
    {
        return $this->average_price;
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @return int|null
     */
    public function getHousesSold(): ?int
    {
        return $this->houses_sold;
    }

    /**
     * @return float|null
     */
    public function getNoOfCrimes(): ?float
    {
        return $this->no_of_crimes;
    }

    /**
     * @return bool|null
     */
    public function getBoroughFlag(): ?bool
    {
        return $this->borough_flag;
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['date'] ?? null,
            $data['area'] ?? null,
            is_numeric($data['average_price']) ? (int) $data['average_price'] : null,
            $data['code'] ?? null,
            is_numeric($data['houses_sold']) ? (int) $data['houses_sold'] : null,
            is_numeric($data['no_of_crimes']) ? (float) $data['no_of_crimes'] : null,
            (bool) $data['borough_flag']
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'date' => $this->date,
            'area' => $this->area,
            'average_price' => $this->average_price,
            'code' => $this->code,
            'houses_sold' => $this->houses_sold,
            'no_of_crimes' => $this->no_of_crimes,
            'borough_flag' => $this->borough_flag,
        ];
    }

    /**
     * @return string[]
     */
    public static function expectedCsvHeaders(): array
    {
        return [
            'date',
            'area',
            'average_price',
            'code',
            'houses_sold',
            'no_of_crimes',
            'borough_flag',
        ];
    }
}

<?php

namespace App\Services;

use App\DataAccess\DTO\HousingDataDTO;
use App\DataAccess\DTO\HousingStatsDTO;
use App\Enums\Area;
use App\Enums\Year;
use App\Exceptions\InvalidCsvStructureException;
use App\Repositories\HousingDataRepository;
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\Exception;
use League\Csv\InvalidArgument;
use League\Csv\SyntaxError;
use League\Csv\UnavailableStream;


/**
 * Class HousingDataService
 */
class HousingDataService
{

    /**
     * @param HousingDataRepository $housingDataRepository
     */
    public function __construct(
        private HousingDataRepository $housingDataRepository
    ) {}

    /**
     * @param $file
     * @param bool $saveToDb
     * @return HousingStatsDTO
     * @throws Exception
     * @throws InvalidArgument
     * @throws SyntaxError
     * @throws UnavailableStream
     * @throws InvalidCsvStructureException
     */
    public function parseAndOptionallySave($file, bool $saveToDb): HousingStatsDTO
    {
        $csv = Reader::createFromPath($file->getPathname(), 'r');
        $csv->setHeaderOffset(0);

        $expectedHeaders = HousingDataDTO::expectedCsvHeaders();

        if(!empty(array_diff($expectedHeaders, $csv->getHeader()))) {
            throw new InvalidCsvStructureException($expectedHeaders, $csv->getHeader());
        }

        $records = collect((new Statement())->process($csv)->getRecords());

        $filtered = $records->map(fn ($row) => HousingDataDTO::fromArray($row));
        $avgPrice = $filtered->avg(fn ($dto) => $dto->average_price);
        $totalSold = $filtered->sum(fn ($dto) => $dto->houses_sold);

        $crimes2011 = $filtered
            ->filter(fn ($dto) => str_starts_with($dto->date, Year::Y2011->toString()))
            ->sum(fn ($dto) => $dto->no_of_crimes);

        $londonAvgPricePerYear = $filtered
            ->filter(fn ($dto) => $dto->area === Area::LONDON->toLowerLetters())
            ->groupBy(fn ($dto) => substr($dto->date, 0, 4))
            ->mapWithKeys(fn ($group, $year) => [
                (string) $year => round($group->avg(fn ($dto) => $dto->average_price))
            ])
            ->toArray();

        if ($saveToDb) {
            $this->housingDataRepository->bulkInsert($filtered);
        }

        return new HousingStatsDTO(
            avgPrice: $avgPrice,
            totalSold: $totalSold,
            crimes2011: $crimes2011,
            londonAvgPricePerYear: $londonAvgPricePerYear
        );
    }
}

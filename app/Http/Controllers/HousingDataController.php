<?php

namespace App\Http\Controllers;

use App\Http\Requests\HousingDataRequest;
use App\Http\Resources\HousingStatsResource;
use App\Services\HousingDataService;
use League\Csv\Exception;
use League\Csv\InvalidArgument;
use League\Csv\SyntaxError;
use App\Exceptions\InvalidCsvStructureException;


/**
 * Class HousingDataController
 */
class HousingDataController extends Controller
{

    /**
     * @param HousingDataService $housingDataService
     */
    public function __construct(
        public HousingDataService $housingDataService
    ) {}

    /**
     * @param HousingDataRequest $request
     * @return HousingStatsResource
     * @throws Exception
     * @throws InvalidArgument
     * @throws SyntaxError
     * @throws InvalidCsvStructureException
     */
    public function upload(HousingDataRequest $request): HousingStatsResource
    {
        $validated = $request->validated();

        $stats = $this->housingDataService->parseAndOptionallySave(
            $validated['file'],
            $validated['save_to_db'] ?? false
        );

        return new HousingStatsResource($stats);
    }
}

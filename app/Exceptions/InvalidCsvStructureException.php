<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;


/**
 * Class InvalidCsvStructureException
 */
class InvalidCsvStructureException extends Exception
{

    /**
     * @param array $expected
     * @param array $received
     */
    public function __construct(array $expected, array $received)
    {
        parent::__construct('Invalid CSV file structure.');
        $this->expected = $expected;
        $this->received = $received;
    }

    /**
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return response()->json([
            'message' => $this->getMessage(),
            'expected_headers' => $this->expected,
            'received_headers' => $this->received,
        ], 422);
    }
}

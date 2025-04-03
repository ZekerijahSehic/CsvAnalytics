<?php

namespace Tests\Feature\Helpers;

/**
 * Class CsvStructureHelper
 */
class CsvStructureHelper
{

    public static function getExpectedInvalidCsvJsonStructure(): array
    {
        return [
            'message',
            'expected_headers',
            'received_headers',
        ];
    }

    public static function getExceptedMessageInvalidCsvJsonStructure(): string
    {
        return 'Invalid CSV file structure.';
    }

    public static function getExpectedHeaders(): array
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

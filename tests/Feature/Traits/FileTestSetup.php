<?php

namespace Tests\Feature\Traits;

use Illuminate\Http\UploadedFile;


/**
 * Trait FileTestSetup
 */
trait FileTestSetup
{

    protected function setUpFile($correctFileFormat = true, $correctDataFormat = true, $emptyFile = false): UploadedFile
    {
        if($correctFileFormat && $correctDataFormat) {
            $filePath = base_path('tests/Fixtures/test_housing_data.csv');
        } else if ($correctFileFormat && !$correctDataFormat) {
            $filePath = base_path('tests/Fixtures/wrong_test_housing_data.csv');
        } else if ($emptyFile) {
            $filePath = base_path('tests/Fixtures/test_housing_data_empty.csv');
        }
        else {
            $filePath = base_path('tests/Fixtures/wrong_file_format.txt');
        }

        $file = new UploadedFile(
            $filePath,
            'housing_data.csv',
            'csv',
            null,
            true
        );

        return $file;
    }
}

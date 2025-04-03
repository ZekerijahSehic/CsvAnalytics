<?php

namespace Tests\Feature\Http\Controllers;

use Tests\Feature\Helpers\HousingStatsHelper;
use Tests\Feature\Helpers\CsvStructureHelper;
use Tests\TestCase;
use Tests\Feature\Traits\FileTestSetup;


/**
 * Class HousingDataControllerTest
 */
class HousingDataControllerTest extends TestCase
{

    use FileTestSetup;

    public function testUploadWithoutSavingToDb(): void
    {
        $file = $this->setUpFile();

        $response = $this->postJson(route('uploadAndProcess'), [
            'file' => $file,
            'save_to_db' => false,
        ]);

        $response->assertOk();
        $response->assertJsonStructure(HousingStatsHelper::getExpectedJsonStructure());
        $this->assertDatabaseEmpty('housing_data');
    }

    public function testUploadWithSavingToDb(): void
    {
        $file = $this->setUpFile();

        // Get the number of rows in the CSV file, excluding the header.
        // Each row in the CSV file will be saved as a record in the database.
        $numOfRecords = count(file(base_path('tests/Fixtures/test_housing_data.csv'))) - 1;

        $response = $this->postJson(route('uploadAndProcess'), [
            'file' => $file,
            'save_to_db' => true,
        ]);

        $response->assertOk();
        $response->assertJsonStructure(HousingStatsHelper::getExpectedJsonStructure());
        $this->assertDatabaseCount('housing_data', $numOfRecords);
    }

    public function testUploadFailsWithInvalidCsvStructure(): void
    {
        $file = $this->setUpFile(true, false);

        $response = $this->postJson(route('uploadAndProcess'), [
            'file' => $file,
            'save_to_db' => false,
        ]);

        $response->assertUnprocessable();
        $response->assertJsonStructure(CsvStructureHelper::getExpectedInvalidCsvJsonStructure());
        $response->assertJsonPath('message', CsvStructureHelper::getExceptedMessageInvalidCsvJsonStructure());
        $response->assertJsonPath('expected_headers', CsvStructureHelper::getExpectedHeaders());
    }

    public function testUploadFailsWithInvalidFileFormat(): void
    {
        $file = $this->setUpFile(false, false);

        $response = $this->postJson(route('uploadAndProcess'), [
            'file' => $file,
            'save_to_db' => false,
        ]);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['file']);
    }

    public function testUploadWithEmptyCsvDoesNothing(): void
    {
        $file = $this->setUpFile(false, false, true);

        $response = $this->postJson(route('uploadAndProcess'), [
            'file' => $file,
            'save_to_db' => true,
        ]);

        $this->assertDatabaseEmpty('housing_data');
    }

    public function testUploadFailsWithoutFile(): void
    {
        $response = $this->postJson(route('uploadAndProcess'), []);

        $response->assertUnprocessable();
        $response->assertJsonPath('message', 'The file field is required.');
    }
}

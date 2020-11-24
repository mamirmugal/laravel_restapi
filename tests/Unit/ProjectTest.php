<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\PropertiesService;
use App\Services\AnalyticTypesService;
use App\Services\PropertyAnalyticsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Indicates whether the database should be seeded before each test.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * Test to see if all Analytic Types are coming through
     *
     * @return void
     */
    public function testAnalyticTypesService()
    {
        // getting all the records
        $records = AnalyticTypesService::getAll();

        // Testing the first one
        $first = $records->first();
        $this->assertEquals('max_Bld_Height_m', $first->name);

        // Testing the last one
        $last = $records->last();
        $this->assertEquals('fsr', $last->name);
    }


    /**
     * Test to see if all Property Analytic create method
     *
     * @return void
     */
    public function testPropertyAnalyticsServiceCreate(){
        
        // Creating Property Analytics
        $propertyAnalyticsId = PropertyAnalyticsService::create([
            "property_id" => 10,
            "analytic_type_id" => 3,
            "value" => 30
        ]);

        $this->assertIsInt($propertyAnalyticsId);
    }

    /**
     * Test to see if all Property Analytic update method
     *
     * @return void
     */
    public function testPropertyAnalyticsServiceUpdate(){
        
        // Updating Property Analytics
        $propertyAnalyticsId = PropertyAnalyticsService::update([
            "value" => 30
        ], 10);

        $this->assertIsInt($propertyAnalyticsId);
    }

    /**
     * Test the summary of all property analytics by state
     *
     * @return void
     */
    public function testPropertiesServiceSummaryByState(){
        
        // Getting the summary by state
        $summaryByState = PropertiesService::getSummaryByState('NSW');

        $this->assertIsFloat($summaryByState['withoutValuePercentage']);
        $this->assertIsFloat($summaryByState['withValuePercentage']);
        $this->assertEquals($summaryByState['median'], 22);
        $this->assertIsFloat($summaryByState['max'], 1103.0);
        $this->assertIsFloat($summaryByState['min'], 0.86175913635948);
    }
}

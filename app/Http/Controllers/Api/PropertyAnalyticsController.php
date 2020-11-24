<?php

namespace App\Http\Controllers\api;

use App\Models\Properties;
use Illuminate\Http\Request;
use App\Services\PropertiesService;
use Illuminate\Support\Facades\Validator;
use App\Services\PropertyAnalyticsService;
use App\Http\Controllers\Api\BaseController;

class PropertyAnalyticsController extends BaseController
{

    /**
     * Adding a analytics of a property
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        // Input validation with custom response message
        $validator = Validator::make($input, [
            'property_id' => 'required',
            'analytic_type_id' => 'required',
            'value' => 'required'
        ],[
            'required' => 'The :attribute field is required'
        ]);

        if($validator->fails()){
            // Collecting all the errors and sending out 401 response
            $errors = collect($validator->errors()->all())->join(', ', ' and ');
            return $this->send401JsonResponse($error);
        }

        // Creating property analytics 
        $property_analytics_id = PropertyAnalyticsService::create($input);

        return $this->send200JsonResponse('Property Analytics has successfully been created and it ID is '.$property_analytics_id.'.');
    }

    /**
     * Updating analytics of a property
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Updating analytics of a property
        PropertyAnalyticsService::update($request->all(), $id);

        return $this->send200JsonResponse('Property Analytics has successfully been updated');
    }

    /**
     * Show the summary of all the property analytics by suburb
     * This will return the min, max, median value and 
     * percentage properties with and without value
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $suburb
     * @return \Illuminate\Http\Response
     */
    public function suburb(Request $request, $suburb)
    {
        // Calculating and returning the summary by suburb
        if($result = PropertiesService::getSummaryBySuburb($suburb))
            return $this->sendJsonResponse($result);
        else 
            return $this->send404JsonResponse('Suburb not found.');

    }

    /**
     * Show the summary of all the property analytics by state
     * This will return the min, max, median value and 
     * percentage properties with and without value
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $state
     * @return \Illuminate\Http\Response
     */
    public function state(Request $request, $state)
    {
        // Calculating and returning the summary by state
        if($result = PropertiesService::getSummaryByState($state))
            return $this->sendJsonResponse($result);
        else 
            return $this->send404JsonResponse('State not found.');
    }

    /**
     * Show the summary of all the property analytics by country
     * This will return the min, max, median value and 
     * percentage properties with and without value
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $country
     * @return \Illuminate\Http\Response
     */
    public function country(Request $request, $country)
    {
        // Calculating and returning the summary by country
        if($result = PropertiesService::getSummaryByCountry($country))
            return $this->sendJsonResponse($result);
        else 
            return $this->send404JsonResponse('Country not found.');
    }

    
}

<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Services\PropertiesService;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseController;

class PropertiesController extends BaseController
{
    /**
     * Display a list of properties
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = PropertiesService::getAll();
        return $this->sendJsonResponse($products);
    }

    /**
     * Saving a property
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        // Validating property input values
        $validator = Validator::make($input, [
            'suburb' => 'required',
            'state' => 'required',
            'country' => 'required'
        ],[
            'required' => 'Field :attribute is required'
        ]);

        // Validating and showing errors
        if($validator->fails()){
            $errors = collect($validator->errors()->all())->join(', ', ' and ');
            return $this->send401JsonResponse($errors);
        }

        // Saving the property 
        $property_id = PropertiesService::create($input);

        // Showing success message
        return $this->send200JsonResponse('Property Analytics has successfully been created and it ID is '.$property_id);
    }

    /**
     * Display the specified property.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $property = PropertiesService::find($id);
        
        return $this->sendJsonResponse($property);
    }

}

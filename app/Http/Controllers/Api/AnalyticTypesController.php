<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Services\AnalyticTypesService;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseController;

class AnalyticTypesController extends BaseController
{
    /**
     * Display a list of the Analytic Types
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $analyticTypes = AnalyticTypesService::getAll();
        return $this->sendJsonResponse($analyticTypes);
    }

}

<?php 

namespace App\Services;

use App\Models\Properties;
use App\Models\AnalyticTypes;
use Illuminate\Database\Eloquent\Collection;

class AnalyticTypesService
{
    /**
     * Getting list of all analytic types
     * 
     * @return Collection
     */
    public static function getAll(){
        return AnalyticTypes::all();
    }
}
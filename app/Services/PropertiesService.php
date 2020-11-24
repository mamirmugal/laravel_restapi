<?php 

namespace App\Services;

use App\Models\Properties;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;

class PropertiesService
{

    /**
     * Getting list of all properties
     * 
     * @return Collection
     */
    public static function getAll(){
        return Properties::all();
    }

    /**
     * Getting all analytics of a specific properties
     * 
     * @param  int          $id
     * @return Collection
     */
    public static function find($id){
        $specificProperty = Properties::find($id);

        return $specificProperty->analytics;
    }

    /**
     * Create Property and return it's Id
     * 
     * @param   array   $input  Contains the the value which need to be added
     * @return  int 
     */
    public static function create($input){
        $input['guid'] = Str::uuid();
        $property = Properties::create($input);

        return $property;
    }

    /**
     * Calculating min, max, median of the analytics value
     * and also percentage properties with and without value 
     * 
     * @param Properties $properties
     * @return array
     */
    private static function calculateSummary(Collection $properties){
        
        $collectiveValues = [];
        $withValue = 0;
        $withoutValue = 0;
        $totalProperties = $properties->count();

        // if nothing is found then return false
        if($totalProperties == 0)
            return false;

        foreach($properties as $property){
            
            // Calculating with and without values
            if(count($property->analytics))
                $withValue++;
            else 
                $withoutValue++;

            // Collecting property values
            foreach($property->analytics as $analytics){
                $collectiveValues[] = $analytics->value;
            }
        }

        return [
            "withoutValuePercentage" => round(($withoutValue/$totalProperties)*100, 2),
            "withValuePercentage" => round(($withValue/$totalProperties)*100, 2),
            "median" => collect($collectiveValues)->median(),
            "max" => (float) collect($collectiveValues)->max(),
            "min" => (float) collect($collectiveValues)->min(),
        ];

    }
    
    /**
     * Show the summary of all the property analytics by suburb
     * This will return the min, max, median value and 
     * percentage properties with and without value
     * 
     * @param   string   $suburb
     * @return  int 
     */
    public static function getSummaryBySuburb($suburb){
        
        $properties = Properties::where('suburb', $suburb)->get();
        
        // Calculating the summary
        return self::calculateSummary($properties);
    }
    
    /**
     * Show the summary of all the property analytics by state
     * This will return the min, max, median value and 
     * percentage properties with and without value
     * 
     * @param   string   $suburb
     * @return  int 
     */
    public static function getSummaryByState($state){
        
        $properties = Properties::where('state', $state)->get();
        
        // Calculating the summary
        return self::calculateSummary($properties);
    }
    
    /**
     * Show the summary of all the property analytics by country
     * This will return the min, max, median value and 
     * percentage properties with and without value
     * 
     * @param   string   $suburb
     * @return  int 
     */
    public static function getSummaryByCountry($country){
        
        $properties = Properties::where('country', $country)->get();
        
        // Calculating the summary
        return self::calculateSummary($properties);
    }
    
}
<?php 

namespace App\Services;

use App\Models\PropertyAnalytics;

class PropertyAnalyticsService
{

    /**
     * Create Property Analytics and return it's Id
     * 
     * @param   array   $input  Contains the the value which need to be added
     * @return  int 
     */
    public static function create($input){
        $propertyAnalytics = PropertyAnalytics::create($input);

        return $propertyAnalytics->id;
    }

    /**
     * Updating Property Analytics and return it's Id
     * 
     * @param   array   $input  Contains the the value which need to be changes
     * @param   int     $id     ID of the row to be updated    
     * @return  int 
     */
    public static function update($input, $id){
        $propertyAnalytics = PropertyAnalytics::find($id);

        if(isset($input['value']))    
            $propertyAnalytics->value = $input['value'];
        
        $propertyAnalytics->save();

        return $propertyAnalytics->id;
    }
    
}
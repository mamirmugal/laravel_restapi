<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'properties';
    protected $dates = [
        'create_at',
        'update_at'
    ];

    protected $fillable = [
        'guid',
        'suburb',
        'state',
        'country',
        'create_at',
        'update_at'
    ];

    /**
     * Property relationship with property analytics
     */
    public function analytics()
    {
        return $this->hasMany('App\Models\PropertyAnalytics', 'property_id');
    }
}

<?php

namespace App\Models;

use App\Models\PPApp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visa extends Model
{
    use HasFactory;

    protected $table = 'visas';

    protected $fillable = [
        'ppapp_id',
        'type_of_visa',
        'visa_category',
        'visa_start_date',
        'visa_end_date',
        'purpose_of_travel',
        'travel_itinerary',
        'sponsor_information',
        'target_country',
        'status'
    ];

    // Define the relationship with PPApp model
    public function ppApp()
    {
        return $this->belongsTo(PPApp::class, 'ppapp_id', 'id');
    }

}

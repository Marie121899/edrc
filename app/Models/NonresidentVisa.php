<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonresidentVisa extends Model
{
    use HasFactory;

    protected $table = 'nonresident_visas';

    protected $fillable = [
        'nonresident_id',
        'type_of_visa',
        'visa_category',
        'visa_start_date',
        'visa_end_date',
        'purpose_of_travel',
        'travel_itinerary',
        'sponsor_information',
        'status'
    ];

    public function nonresident()
    {
        return $this->belongsTo(Nonresident::class);
    }    

}

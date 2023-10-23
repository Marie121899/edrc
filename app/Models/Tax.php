<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;

    protected $table = 'taxes';

    protected $fillable = [
        'tax_type',
        'amount',
        'due_date',
        'payment_status',
        'tax_year',
        'business_id',
        'citizen_id',
        'description',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id', 'id');
    }

    public function citizen()
    {
        return $this->belongsTo(Citizen::class, 'citizen_id', 'id');
    }
    
}

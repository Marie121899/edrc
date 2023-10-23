<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class License extends Model
{
    use HasFactory;

    protected $table = 'licenses';

    protected $dates = ['issue_date', 'expiration_date'];

    protected $fillable = [
        'business_id',
        'license_number',
        'issue_date',
        'period',
        'status', // Enum field
        'description',
        'expiration_date',
        'renewal_date',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function calculateIssueDate($selectedDate)
    {
        // Add five business days to the selected date
        $issueDate = Carbon::parse($selectedDate)->addWeekdays(5);
        return $issueDate;
    }
    
    public function calculateExpirationDate($selectedDate, $period)
    {
        // Calculate the expiration date based on the selected date and period
        $issueDate = $this->calculateIssueDate($selectedDate);
        $expirationDate = $issueDate->addMonths($period);
        return $expirationDate;
    }
    public function setPeriodAttribute($value)
    {
        if (in_array($value, [1, 3, 6, 12])) {
            $this->attributes['period'] = $value;
            $this->attributes['issue_date'] = $this->calculateIssueDate($this->attributes['issue_date']);
            $this->attributes['expiration_date'] = $this->calculateExpirationDate($this->attributes['issue_date'], $value);
        }
    }

        
}

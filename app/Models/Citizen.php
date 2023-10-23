<?php

namespace App\Models;

use App\Models\PPApp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Citizen extends Model
{
    use HasFactory;

    protected $table = 'citizens';

    protected $fillable  = [
        'lname',
        'surname',
        'dob',
        'idnumber',
        'phone',
        'address',
        'gender',
        'city',
        'profile'
    ];

            // Define the relationship with the User model
            public function user()
            {
                return $this->belongsTo(User::class, 'user_id', 'id');
            }

            public function passportApplications()
            {
                return $this->hasMany(PPApp::class, 'citizen_id', 'id');
            }

            public function taxes()
            {
                return $this->hasMany(Tax::class);
            }

            
}

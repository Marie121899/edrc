<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admins';

    protected $fillable  = [
        'lname',
        'surname',
        'dob',
        'idnumber',
        'phone',
        'address',
        'gender',
        'profile'
    ];

      // Define the relationship with the User model
      public function user()
      {
          return $this->belongsTo(User::class, 'user_id', 'id');
      }
      
}

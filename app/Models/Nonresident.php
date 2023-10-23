<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nonresident extends Model
{
    use HasFactory;

    protected $table = 'nonresidents';

    protected $fillable  = [
        'lname',
        'surname',
        'dob',
        'passportnumber',
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

      public function visas()
      {
          return $this->hasMany(NonresidentVisa::class);
      }
      
}

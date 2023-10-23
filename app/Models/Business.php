<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $table = 'businesses';

    protected $fillable  = [
        'businessname',
        'dateofregistration',
        'businessnumber',
        'phone',
        'address',
        'industry',
        'profile'
    ];

      // Define the relationship with the User model
      public function user()
      {
          return $this->belongsTo(User::class, 'user_id', 'id');
      }
      public function taxes()
      {
          return $this->hasMany(Tax::class);
      }
}

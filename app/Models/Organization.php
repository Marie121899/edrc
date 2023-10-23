<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $table = 'organizations';

    protected $fillable  = [
        'orgname',
        'dateofregistration',
        'orgnumber',
        'phone',
        'address',
        'profile'
    ];

      // Define the relationship with the User model
      public function user()
      {
          return $this->belongsTo(User::class, 'user_id', 'id');
      }
      
}

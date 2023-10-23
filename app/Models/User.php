<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Admin;
use App\Models\PPApp;
use App\Models\Citizen;
use App\Models\Business;
use App\Models\Nonresident;
use App\Models\Organization;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'type',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

        /**
     * Interact with the user's first name.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function type(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                $types = ["citizen", "admin", "nonresident", "business", "organization"];
                return isset($types[$value]) ? $types[$value] : null;
            }
        );
    }

    public function citizens()
    {
        return $this->hasMany(Citizen::class);
    }

    public function nonresidents()
    {
        return $this->hasMany(Nonresident::class);
    }

    public function organizations()
    {
        return $this->hasMany(Organization::class);
    }

    public function admins()
    {
        return $this->hasMany(Admin::class);
    }

    public function businesses()
    {
        return $this->hasMany(Business::class);
    }

    public function passportApplications()
    {
        return $this->hasMany(PPApp::class)->where('citizen_id', $this->id);
    }

    public function nonresidentvisas()
    {
        return $this->hasMany(NonresidentVisa::class);
    }
    

}

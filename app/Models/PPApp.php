<?php

namespace App\Models;

use App\Models\Citizen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PPApp extends Model
{
    use HasFactory;

    protected $table = 'p_p_apps';

    protected $fillable  = [
        'citizen_id',
        'applicant_id_copy',
        'father_birthcertificate',
        'mother_birthcertificate',
        'applicant_birthcertificate',
        'date_to_submit_biometrics',
        'status',
        'passport_size_photos'
    ];

    public function citizen()
    {
        return $this->belongsTo(Citizen::class, 'citizen_id', 'id');
    }

    public function visas()
    {
        return $this->hasMany(Visa::class);
    }
    
}

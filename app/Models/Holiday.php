<?php

namespace App\Models\LicenseWork;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;
    protected $table= 'license.holidays';
    protected $filable=[
        'number_days',
        'year',

    ];
    function employee(){
        return $this->belongsTo();
    }
}

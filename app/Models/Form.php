<?php

namespace App\Models\LicenseWork;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;
    protected $table= 'license.forms';
    protected $filable=[
        'code',
        'description',
        'regime',
        'days_const',
        'approved_level',
        'state',

    ];
    function employer(){
        return $this->belongsTo();
    }
    // Scopes
    public function scopeCode($query, $code)
    {
        if ($code) {
            return $query->orWhere('code', 'ILIKE', "%$code%");
        }
    }

    public function scopeRegime($query, $regime)
    {
        if ($regime) {
            return $query->orWhere('regime', 'ILIKE', "%$regime%");
        }
    }
}
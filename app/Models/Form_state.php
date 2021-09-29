<?php

namespace App\Models\LicenseWork;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form_state extends Model
{
    use HasFactory;
    protected $table= 'license.form_states';
    
    function form(){
        return $this->belongsTo();
    }
    function state(){
        return $this->belongsTo();
    }
    function dependenceUser(){
        return $this->belongsTo();
    }
}

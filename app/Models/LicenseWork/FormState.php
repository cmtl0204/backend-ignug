<?php

namespace App\Models\LicenseWork;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormState extends Model
{
    use HasFactory;
    protected $table= 'license_work.form_state';

    function form(){
        return $this->belongsTo(Form::class);
    }
    function state(){
        return $this->belongsTo(State::class);
    }

    function dependenceUser(){
        return $this->belongsTo();
    }
}

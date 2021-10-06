<?php

namespace App\Models\LicenseWork;

use App\Models\Authentication\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dependence extends Model
{
    use HasFactory;
    protected $table= 'license_work.dependence';
    protected $fillable=[
        'name',
        'level',
    ];
public function users(){
    return $this->belongsTo(User::class);
} 
}

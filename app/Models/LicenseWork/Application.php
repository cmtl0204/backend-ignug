<?php

namespace App\Models\LicenseWork;

use App\Models\Core\Catalogue;
use App\Models\Core\Location;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $table='license_work.applications';
    protected $fillable=[
        'date_started_at',
        'date_ended_at',
        'time_started_at',
        'time_ended_at',
        'observations',
    ];

    function employee(){
        return $this->belongsTo(Employee::class);
    }

    function reason(){
        return $this->belongsTo(Reason::class);
    }
    function location(){
        return $this->belongsTo(Location::class);
    }

    function type(){
        return $this->belongsTo(Catalogue::class);
    }
}

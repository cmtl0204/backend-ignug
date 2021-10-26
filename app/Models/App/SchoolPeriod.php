<?php

namespace App\Models\App;

// Laravel
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditing;

// Traits State
use Illuminate\Database\Eloquent\SoftDeletes;


// Models
use App\Models\Authentication\User;
use App\Models\Attendance\Attendance;
use App\Models\Core\State;

class SchoolPeriod extends Model implements Auditable
{
    use HasFactory;
    use Auditing;
    use SoftDeletes;

   

    protected $table = 'app.school_periods';

    protected $fillable = [
        'code',
        'name',
        'started_at',
        'ended_at',
        'ordinary_started_at',
        'ordinary_ended_at',
        'extraordinary_started_at',
        'extraordinary_ended_at',
        'especial_started_at',
        'especial_ended_at',
    ];

    

    // Relationsships
    public function state()
    {
        return $this->belongsTo(State::class);
    }
}

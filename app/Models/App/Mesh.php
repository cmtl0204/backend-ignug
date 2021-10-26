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
use App\Models\Uic\Student;

class Mesh extends Model implements Auditable
{
    use HasFactory;
    use Auditing;
    use SoftDeletes;

    protected $table = 'app.meshes';

    protected $fillable = [
        'name',
        'started_at',
        'ended_at',
        'resolution_number',
        'number_weeks',
    ];

    // Relationsships
    public function career()
    {
        return $this->belongsTo(Career::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}

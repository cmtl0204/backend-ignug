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
use App\Models\Core\Catalogue;

class Teacher extends Model implements Auditable
{
    use HasFactory;
    use Auditing;
    use SoftDeletes;

  

    protected $table = 'app.teachers';

    protected $fillable = [
        'total_subjects',
        'hours_worked',
        'class_hours',
        'investigation_hours',
        'administrative_hours',
        'community_hours',
        'other_hours',
        'total_publications',
        'scholarship_amount',
        'technical',
        'technology',
        'sabbatical',
        'publications',
        'academic_unit',
        'institution_higher_education',
        'degree_higher_education',
        'start_sabbatical',
    ];

    

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function teachingLadder()
    {
        return $this->belongsTo(Catalogue::class);
    }
    public function dedicationTime()
    {
        return $this->belongsTo(Catalogue::class);
    }
    public function higherEducation()
    {
        return $this->belongsTo(Catalogue::class);
    }
    public function countryHigherEducation()
    {
        return $this->belongsTo(Catalogue::class);
    }
    public function scholarship()
    {
        return $this->belongsTo(Catalogue::class);
    }
    public function scholarshipType()
    {
        return $this->belongsTo(Catalogue::class);
    }
    public function financingType()
    {
        return $this->belongsTo(Catalogue::class);
    }
}

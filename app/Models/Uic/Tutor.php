<?php

namespace App\Models\Uic;

use App\Models\App\Teacher;
use App\Models\Core\Catalogue;
use App\Models\Core\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditing;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;


/**
 * @property BigInteger id
 * @property array observations
 */
class Tutor extends Model implements Auditable
{
    use HasFactory;
    use Auditing;
    use SoftDeletes;
     

    protected $table = 'uic.tutors';

    protected $fillable = [
        'observations',
    ];

    protected $casts = [
        'observations' => 'array',
    ];
    
    protected $cascadeDeletes = ['files'];

    // Relationships

    public function tutorShips()
    {
        return $this->hasMany(TutorShip::class);
    }

    public function projectPlan()
    {
        return $this->belongsTo(ProjectPlan::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function type()
    {
        return $this->belongsTo(Catalogue::class);
    }

    // Scopes
    public function scopeCustomOrderBy($query, $sorts)
    {
        if (!empty($sorts[0])) {
            foreach ($sorts as $sort) {
                $field = explode('-', $sort);
                if (empty($field[0]) && in_array($field[1], $this->fillable)) {
                    $query = $query->orderByDesc($field[1]);
                } else if (in_array($field[0], $this->fillable)) {
                    $query = $query->orderBy($field[0]);
                }
            }
            return $query;
        }
    }

    public function scopeCustomSelect($query, $fields)
    {
        if (!empty($fields)) {
            $fields = explode(',', $fields);
            array_unshift($fields, 'id');
            return $query->select($fields);
        }
    }

    public function scopeObservations($query, $Observations)
    {
        if ($Observations) {
            return $query->where('observations', 'ILIKE', "%$Observations%");
        }
    }

    // Mutators
    public function setObservationsAttribute($value)
    {
        $this->attributes['observations'] = strtoupper($value);
    }

}

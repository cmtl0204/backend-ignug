<?php

namespace App\Models\Uic;

use App\Models\App\SchoolPeriod;
use App\Models\Core\Catalogue;
use App\Models\Core\File;
use App\Models\Core\State;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditing;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;


/**
 * @property BigInteger id
 * @property date registered_at
 * @property string code
 * @property array observations
 */
class Enrollment extends Model implements Auditable
{
    use HasFactory;
    use Auditing;
    use SoftDeletes;
    use CascadeSoftDeletes;

    protected $table = 'uic.enrollments';

    protected $fillable = [
        'registered_at',
        'code',
        'observations',
    ];

    protected $cascadeDeletes = ['files'];

    // Relationships
    public function tutorShips()
    {
        return $this->hasMany(TutorShip::class);
    }
    
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function modality()
    {
        return $this->belongsTo(Modality::class);
    }

    public function schoolPeriod()
    {
        return $this->belongsTo(SchoolPeriod::class);
    }

    public function meshStudent()
    {
        return $this->belongsTo(MeshStudent::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
    
    public function planning()
    {
        return $this->belongsTo(Planning::class);
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

    public function scopeCode($query, $code)
    {
        if ($code) {
            return $query->where('code', 'ILIKE', "%$code%");
        }
    }

    // Mutators
    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = strtoupper($value);
    }

}

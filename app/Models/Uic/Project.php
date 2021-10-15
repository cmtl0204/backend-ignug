<?php

namespace App\Models\Uic;

use App\Models\Core\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditing;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;


/**
 * @property BigInteger id
 * @property string title
 * @property string description
 * @property string total_advance
 * @property string tutor_asigned
 * @property integer score
 * @property boolean approved
 * @property array observations
 */
class Project extends Model implements Auditable
{
    use HasFactory;
    use Auditing;
    use SoftDeletes;
    use CascadeSoftDeletes;

    protected $table = 'uic.projects';

    protected $fillable = [
        'title',
        'description',
        'score',
        'approved',
        'total_advance',
        'tutor_asigned',
        'observations',
    ];

    protected $cascadeDeletes = ['files'];

    // Relationships
    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function projectPlan()
    {
        return $this->belongsTo(ProjectPlan::class);
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

    public function scopeFieldProyect($query, $fieldProject)
    {
        if ($fieldProject) {
            return $query->where('field_projects', 'ILIKE', "%$fieldProject%");
        }
    }

    // Mutators
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = strtoupper($value);
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = strtoupper($value);
    }

    public function setScoreAttribute($value)
    {
        $this->attributes['score'] = strtoupper($value);
    }

    public function setApprovedAttribute($value)
    {
        $this->attributes['approved'] = strtoupper($value);
    }

    public function setTotalAdvancenAttribute($value)
    {
        $this->attributes['total_advance'] = strtoupper($value);
    }

    public function setTutorAsignedAttribute($value)
    {
        $this->attributes['tutor_asigned'] = strtoupper($value);
    }

}

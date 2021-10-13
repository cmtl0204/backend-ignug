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
 * @property string field_title
 * @property string field_description
 * @property integer score
 * @property boolean approved
 * @property string field_total_advance
 * @property string field_tutor_asigned
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
        'field_projects',
    ];

    protected $cascadeDeletes = ['files'];

    // Relationships
    public function enrollmen()
    {
        return $this->belongsTo(Enrollmen::class, 'fileable');
    }

    public function projectPlan()
    {
        return $this->belongsTo(ProjectPlan::class, 'fileable');
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
    public function setFieldProjectAttribute($value)
    {
        $this->attributes['field_projects'] = strtoupper($value);
    }

}

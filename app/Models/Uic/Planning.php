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
 * @property string field_planning
 * @property string field_description
 * @property integer score
 * @property boolean approved
 * @property string field_total_advance
 * @property string field_tutor_asigned
 * @property array observations
 */
class Planning extends Model implements Auditable
{
    use HasFactory;
    use Auditing;
    use SoftDeletes;
    use CascadeSoftDeletes;

    protected $table = 'uic.planning';

    protected $fillable = [
        'field_planning',
    ];

    protected $cascadeDeletes = ['files'];

    // Relationships
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    // Scopes
    public function scopeUicOrderBy($query, $sorts)
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

    public function scopeUicSelect($query, $fields)
    {
        if (!empty($fields)) {
            $fields = explode(',', $fields);
            array_unshift($fields, 'id');
            return $query->select($fields);
        }
    }

    public function scopeFieldPlanning($query, $fieldPlanning)
    {
        if ($fieldPlanning) {
            return $query->where('field_planning', 'ILIKE', "%$fieldPlanning%");
        }
    }

    // Mutators
    public function setFieldPlanningAttribute($value)
    {
        $this->attributes['field_planning'] = strtoupper($value);
    }

}

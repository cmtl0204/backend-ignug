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
 * @property string field_act_code
 * @property date field_approval_date
 * @property boolean field_act_code
 * @property array observations
 */
class ProjectPlan extends Model implements Auditable
{
    use HasFactory;
    use Auditing;
    use SoftDeletes;
    use CascadeSoftDeletes;

    protected $table = 'schema.table';

    protected $fillable = [
        'field_example',
    ];

    protected $cascadeDeletes = ['files'];

    // Relationships

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

    public function scopeFieldExample($query, $fieldProjectPlan)
    {
        if ($fieldProjectPlan) {
            return $query->where('field_ProjectPlan', 'ILIKE', "%$fieldProjectPlan%");
        }
    }

    // Mutators
    public function setFieldProjectPlanAttribute($value)
    {
        $this->attributes['field_ProjectPlan'] = strtoupper($value);
    }

}

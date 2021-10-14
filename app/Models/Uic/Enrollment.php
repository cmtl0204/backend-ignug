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
 * @property string field_enrollment
 * @property string field_act_code
 * @property date field_approval_date
 * @property boolean field_act_code
 * @property array observations
 */
class Enrollment extends Model implements Auditable
{
    use HasFactory;
    use Auditing;
    use SoftDeletes;
    use CascadeSoftDeletes;

    protected $table = 'uic.enrollment';

    protected $fillable = [
        'field_enrollment',
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

    public function scopeFieldEnrollment($query, $fieldEnrollment)
    {
        if ($fieldEnrollment) {
            return $query->where('field_enrollment', 'ILIKE', "%$fieldEnrollment%");
        }
    }

    // Mutators
    public function setFieldEnrollmentAttribute($value)
    {
        $this->attributes['field_enrollment'] = strtoupper($value);
    }

}

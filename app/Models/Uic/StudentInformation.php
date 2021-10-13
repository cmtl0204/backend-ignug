<?php

namespace App\Models\Uic;

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
 * @property string company_work
 */
class StudentInformation extends Model implements Auditable
{
    use HasFactory;
    use Auditing;
    use SoftDeletes;
    use CascadeSoftDeletes;

    protected $table = 'uic.student_informations';

    protected $fillable = [
        'company_work',
    ];

    protected $cascadeDeletes = ['files'];

    // Relationships
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function relationLaboralCareer()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function companyArea()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function companyPosition()
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

    public function scopeCompanyWork($query, $companyWork)
    {
        if ($companyWork) {
            return $query->where('company_work', 'ILIKE', "%$companyWork%");
        }
    }

    // Mutators
    public function setFieldCompanyWorkAttribute($value)
    {
        $this->attributes['company_work'] = strtoupper($value);
    }

}

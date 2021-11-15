<?php

namespace App\Models\JobBoard;

use App\Models\Core\Career;
use App\Traits\FileTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditing;

class AcademicFormation extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use Auditing;
    use FileTrait;

    protected $table = 'job_board.academic_formations';

    protected $fillable = [
        'registered_at',
        'senescyt_code',
        'certificated'
    ];

    public function career()
    {
        return $this->belongsTo(Career::class);
    }

    public function professional()
    {
        return $this->belongsTo(Professional::class);
    }

    public function professionalDegree()
    {
        return $this->belongsTo(Category::class);
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

    public function scopeSenescytCode($query, $senescytCode)
    {
        if ($senescytCode) {
            return $query->orWhere('senescyt_code', 'ILIKE', $senescytCode);
        }
    }

    // Mutators

    public function setSenescytCodeAttribute($value)
    {
        $this->attributes['senescyt_code'] = strtoupper($value);
    }

}

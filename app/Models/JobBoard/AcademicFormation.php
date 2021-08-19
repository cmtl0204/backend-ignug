<?php

namespace App\Models\JobBoard;

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

    protected $table = 'job_board.academic_formations';

    protected $fillable = [
        'registration_date',
        'senescyt_code',
        'certificated'
    ];

    protected $casts = [
        'registration_date' => 'datetime'
    ];

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
}

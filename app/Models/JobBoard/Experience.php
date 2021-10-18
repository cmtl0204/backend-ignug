<?php

namespace App\Models\JobBoard;

use App\Traits\FileTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditing;
use Brick\Math\BigInteger;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Core\Catalogue;
use App\Models\Core\File;

/**
 * @property BigInteger id
 * @property string employer
 * @property string position
 * @property date started_at
 * @property date ended_at
 * @property json activities
 * @property string reason_leave
 * @property boolean is_workign
 */
class Experience extends Model implements Auditable
{
    use HasFactory;
    use Auditing;
    use SoftDeletes;
    use FileTrait;

    protected $table = 'job_board.experiences';

    protected $fillable = [
        'activities',
        'ended_at',
        'employer',
        'position',
        'reason_leave',
        'started_at',
        'worked'
    ];

    protected $casts = [
        'activities' => 'array'
    ];

    public function area()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function professional()
    {
        return $this->belongsTo(Professional::class);
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

    public function scopeEmployer($query, $employer)
    {
        if ($employer) {
            return $query->orWhere('employer', 'ILIKE', "%$employer%");
        }
    }

    public function scopePosition($query, $position)
    {
        if ($position) {
            return $query->orWhere('position', 'ILIKE', "%$position%");
        }
    }

    public function scopeReasonLeave($query, $reason_leave)
    {
        if ($reason_leave) {
            return $query->orWhere('reason_leave', 'ILIKE', "%$reason_leave%");
        }
    }

    // Mutators
    public function setEmployerAttribute($value)
    {
        $this->attributes['employer'] = strtoupper($value);
    }

    public function setPositionAttribute($value)
    {
        $this->attributes['position'] = strtoupper($value);
    }

    public function setReasonLeaveAttribute($value)
    {
        $this->attributes['reason_leave'] = strtoupper($value);
    }

}

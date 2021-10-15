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
 * @property date started_at
 * @property date ended_at
 */
class Event extends Model implements Auditable
{
    use HasFactory;
    use Auditing;
    use SoftDeletes;
    use CascadeSoftDeletes;

    protected $table = 'uic.events';

    protected $fillable = [
        'started_at',
        'ended_at',
    ];

    protected $cascadeDeletes = ['files'];

    // Relationships
    public function planning()
    {
        return $this->belongsTo(Planning::class);
    }

    public function name()
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

     // Mutators
     public function setStartedAtkAttribute($value)
     {
         $this->attributes['started_at'] = strtoupper($value);
     }

     public function setEndedAtkAttribute($value)
     {
         $this->attributes['ended_at'] = strtoupper($value);
     }
}

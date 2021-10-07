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
 * @property string name
 * @property string description
 * @property date started_at
 * @property date ended_at
 * @property integer hours
 * @property string institution
 */
class Course extends Model implements Auditable
{
    use HasFactory;
    use Auditing;
    use SoftDeletes;
    use FileTrait;

    protected $table = 'job_board.courses';

    protected $fillable = [
        'description',
        'ended_at',
        'hours',
        'name',
        'started_at',
        'institution'
    ];

    // Relationships
    public function area()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function certificationType()
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

    public function type()
    {
        return $this->belongsTo(Catalogue::class);
    }

    // Mutators
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = strtoupper($value);
    }

    public function setInstitutionAttribute($value)
    {
        $this->attributes['institution'] = strtoupper($value);
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
            foreach ($fields as $field) {
                $fieldExist = array_search(strtolower($field), $fields);
                if ($fieldExist == false) {
                    unset($fields[$fieldExist]);
                }
            }

            array_unshift($fields, 'id');
            return $query->select($fields);
        }
    }
    public function scopeDescription($query, $description)
    {
        if ($description) {
            return $query->where('description', 'ILIKE', "%$description%");
        }
    }

    public function scopeName($query, $name)
    {
        if ($name) {
            return $query->orWhere('name', 'ILIKE', "%$name%");
        }
    }
    
    public function scopeInstitution($query, $institution)
    {
        if ($institution) {
            return $query->orWhere('institution', 'ILIKE', "%$institution%");
        }
    }
}

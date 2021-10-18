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
 * @property string name
 * @property string description
 */
class Modality extends Model implements Auditable
{
    use HasFactory;
    use Auditing;
    use SoftDeletes;
    use CascadeSoftDeletes;

    protected $table = 'uic.modalities';

    protected $fillable = [
        'name',
        'description',
    ];

    protected $cascadeDeletes = ['files'];

    // Relationships
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    } 

    public function parent()
    {
        return $this->belongsTo(Modality::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function career()
    {
        return $this->belongsTo(Career::class);
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

    public function scopeName($query, $name)
    {
        if ($name) {
            return $query->where('companyWork', 'ILIKE', "%$name%");
        }
    }
    
    public function scopeDescription($query, $description)
    {
        if ($description) {
            return $query->where('companyWork', 'ILIKE', "%$description%");
        }
    }

    // Mutators
    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = strtoupper($value);
    }
    
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }

}

<?php

namespace App\Models;

use App\Models\JobBoard\Offer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditing;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Authentication\Role;

class Catalogue extends Model implements Auditable
{
    use HasFactory;
    use Auditing;
    use SoftDeletes;

    protected $table = 'authentication.catalogues';

    protected $fillable = [
        'code',
        'name',
        'type',
        'icon',
    ];

    // Relationsships
    public function parent()
    {
        return $this->belongsTo(Catalogue::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Catalogue::class, 'parent_id');
    }

    public function roles()
    {
        return $this->morphedByMany(Role::class, 'catalogueable');
    }

    public function offer()
    {
        return $this->hasOne(Offer::class);
    }

    // Mutators
    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = strtoupper($value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }

    public function scopeType($query, $type)
    {
        if ($type) {
            return $query->where('type', $type);
        }
    }

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
}

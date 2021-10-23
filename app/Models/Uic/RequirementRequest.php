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
 * @property array observations
 * @property boolean approved
 * @property date registered_at
 */
class RequimentRequest extends Model implements Auditable
{
    use HasFactory;
    use Auditing;
    use SoftDeletes;
     

    protected $table = 'uic.requirement_requests';

    protected $fillable = [
        'observations',
        'registered_at'
    ];

    protected $casts = [
        'observations' => 'array',
    ];

    protected $cascadeDeletes = ['files'];

    // Relationships
    public function requirement()
    {
        return $this->belongsTo(Requirement::class);
    }

    public function meshStudent()
    {
        return $this->belongsTo(MeshStudent::class);
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

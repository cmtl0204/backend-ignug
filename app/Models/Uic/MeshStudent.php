<?php

namespace App\Models\Uic;

use App\Http\Resources\V1\Uic\MeshStudentRequeriment;
use App\Models\App\Mesh;
use App\Models\Core\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditing;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;


/**
 * @property BigInteger id
 * @property boolean approved
 * @property array observations
 */
class MeshStudent extends Model implements Auditable
{
    use HasFactory;
    use Auditing;
    use SoftDeletes;
     

    protected $table = 'uic.mesh_students';

    protected $fillable = [
        'approved',
        'observations',
    ];

    protected $cascadeDeletes = ['files'];

    // Relationships
    public function student()
    {
        return $this->hasMany(Student::class);
    }
    
    public function meshStudentRequirement()
    {
        return $this->hasOne(MeshStudentRequeriment::class);
    }

    public function mesh()
    {
        return $this->belongsTo(Mesh::class);
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

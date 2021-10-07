<?php

namespace App\Models\JobBoard;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Auditable as Auditing;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Brick\Math\BigInteger;
use App\Models\Core\Catalogue;
use App\Models\Core\File;

/**
 * @property BigInteger id
 * @property string institution
 * @property string position
 * @property string contact_name
 * @property string contact_phone
 * @property string contact_email
 */
class Reference extends Model implements Auditable
{
    use HasFactory;
    use Auditing;
    use softDeletes;

    protected $table = 'job_board.references';

    protected $fillable = [
        'contact_email',
        'contact_name',
        'contact_phone',
        'institution',
        'position',
    ];

    // Relationships
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function professional()
    {
        return $this->belongsTo(Professional::class);
    }

    // Mutators
    public function setInstitutionAttribute($value)
    {
        $this->attributes['institution'] = strtoupper($value);
    }

    public function setPositionAttribute($value)
    {
        $this->attributes['position'] = strtoupper($value);
    }

    public function setContactNameAttribute($value)
    {
        $this->attributes['contact_name'] = strtoupper($value);
    }

    public function setContactEmailAttribute($value)
    {
        $this->attributes['contact_email'] = strtolower($value);
    }

    public function setContactPhoneAttribute($value)
    {
        $this->attributes['contact_phone'] = strtoupper($value);
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

    public function scopePosition($query, $position)
    {
        if ($position) {

            return $query->where('position', 'ILIKE', "%$position%");
        }
    }

    public function scopeContactName($query, $contactName)
    {
        if ($contactName) {
            return $query->orWhere('contact_name', 'ILIKE', "%$contactName%");
        }
    }

    public function scopeContactPhone($query, $contactPhone)
    {
        if ($contactPhone) {
            return $query->orWhere('contact_phone', 'ILIKE', "%$contactPhone%");
        }
    }

    public function scopeContactEmail($query, $contactEmail)
    {
        if ($contactEmail) {
            return $query->orWhere('contact_email', 'ILIKE', "%$contactEmail%");
        }
    }
}

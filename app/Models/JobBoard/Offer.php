<?php

namespace App\Models\JobBoard;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Date;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditing;
use App\Models\Core\Catalogue;
use App\Models\Core\State;
use App\Models\Core\Location;
use Dyrynda\Database\Support\CascadeSoftDeletes;

/**
 * @property BigInteger id
 * @property string code
 * @property string contact_name
 * @property string contact_email
 * @property string contact_phone
 * @property string contact_cellphone
 * @property string remuneration
 * @property integer vacancies
 * @property Date started_at
 * @property Date ended_at
 * @property string aditional_information
 * @property json activities
 * @property json requirements
 */
class Offer extends Model implements Auditable
{
    use HasFactory;
    use Auditing;
    use SoftDeletes;
    // use CascadeSoftDeletes;

    protected $table = 'job_board.offers';

    protected $fillable = [
        'code',
        'contact_name',
        'contact_email',
        'contact_phone',
        'contact_cellphone',
        'remuneration',
        'vacancies',
        'started_at',
        'ended_at',
        'aditional_information',
        'position',
        'activities',
        'requirements',
    ];

    protected $cascadeDeletes = ['categories'];

    protected $casts = [
        'activities' => 'array',
        'requirements' => 'array'
    ];

    // Relationships
    public function categories()
    {
        return $this->belongsToMany(Category::class,'job_board.category_offer')->withTimestamps();
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function contractType()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function professionals()
    {
        return $this->belongsToMany(Professional::class,'job_board.offer_professional')->withTimestamps();
    }

    public function sector()
    {
        return $this->belongsTo(Catalogue::class,);
    }

    public function workingDay()
    {
        return $this->belongsTo(Catalogue::class,);
    }

    public function experienceTime()
    {
        return $this->belongsTo(Catalogue::class,);
    }

    public function trainingHours()
    {
        return $this->belongsTo(Catalogue::class,);
    }
    
    public function state()
    {
        return $this->belongsTo(State::class);
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

    public function scopeAditionalInformation($query, $aditionalInformation)
    {
        if ($aditionalInformation) {
            return $query->orWhere('aditional_information', 'ILIKE', "%$aditionalInformation%");
        }
    }

    public function scopeCode($query, $code)
    {
        if ($code) {
            return $query->orWhere('code', 'ILIKE', "%$code%");
        }
    }

    public function scopeProfessional($query, $professional)
    {
        if ($professional) {
            $query->whereDoesntHave('professionals', function ($professionals) use ($professional) {
                $professionals->where('professionals.id', $professional->id);
            });
        }
    }

    public function scopeStatus($query, $status)
    {
        if ($status) {
            return $query->whereHas('status', function ($query) use ($status) {
                $query->where('code', $status);
            });
        }
    }

    public function scopeProvince($query, $province)
    {
        if ($province) {
            $query->whereHas('location', function ($location) use ($province) {
                $location->where('parent_id', $province);
            });
        }
    }

    public function scopeCanton($query, $canton)
    {
        if ($canton) {
            $query->where('location_id', $canton);
        }
    }

    public function scopePosition($query, $position)
    {
        if ($position) {
            $query->whereHas('position', function ($query) use ($position) {
                $query->where('name', 'ILIKE', "%$position%");
            });
        }
    }

    public function scopeIdCategories($query, $categories)
    {
        if ($categories) {
            $query->whereHas('categories', function ($query) use ($categories) {
                $query->whereIn('categories.id', $categories);
            });
        }
    }

    public function scopeParentCategory($query, $category)
    {
        if ($category) {
            $query->whereHas('categories', function ($query) use ($category) {
                $query->whereIn('categories.parent_id', $category);
            });
        }
    }

    // estos scopes son usados en el imput de texto
    public function scopeLocation($query, $location){
        if ($location) {
            return$query->orWhereHas('location', function ($query) use ($location) {
                $query->where('name', 'ILIKE', "%$location%");
            });
        }
    }

    public function scopeCategoryName($query, $name){
        if ($name) {
            return $query->orWhereHas('categories', function ($query) use ($name) {
                $name = strtolower($name);
                $query->Where('name', 'ILIKE',"%$name%");
            });
        }
    }

    // Mutators
    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = strtoupper($value);
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
 
    public function setContactCellphoneAttribute($value)
    {
        $this->attributes['contact_cellphone'] = strtoupper($value);
    }

    public function setRemunerationAttribute($value)
    {
        $this->attributes['remuneration'] = strtoupper($value);
    }

    public function setAdditionalInformationAttribute($value)
    {
        $this->attributes['additional_information'] = strtoupper($value);
    }

}

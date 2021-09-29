<?php

namespace App\Models\JobBoard;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditing;
use Illuminate\Database\Eloquent\SoftDeletes;
use Brick\Math\BigInteger;
use App\Models\Authentication\User;
use App\Models\Core\Catalogue;

/**
 * @property BigInteger id
 * @property string about_me
 */
class Professional extends Model implements Auditable
{
    use HasFactory;
    use Auditing;
    use SoftDeletes;

    protected $table = 'job_board.professionals';

    protected $fillable = [
        'about_me',
        'traveled',
        'disabled',
        'familiar_disabled',
        'identification_familiar_disabled',
        'catastrophic_diseased',
        'familiar_catastrophic_diseased',
    ];

    protected $casts = [
        'traveled' => 'boolean',
        'disabled' => 'boolean',
        'familiar_disabled' => 'boolean',
        'catastrophic_diseased' => 'boolean',
        'familiar_catastrophic_diseased' => 'boolean',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sex()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function gender()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function offers()
    {
        return $this->belongsToMany(Offer::class);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    public function references()
    {
        return $this->hasMany(Reference::class);
    }

    public function academicFormations()
    {
        return $this->hasMany(AcademicFormation::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function professionals()
    {
        return $this->hasMany(Professional::class);
    }

    public function languages()
    {
        return $this->hasMany(Language::class);
    }

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    // Scopes
    public function scopeCompany($query, $company)
    {
        if ($company) {
            $query->whereDoesntHave('companies', function ($companies) use ($company) {
                $companies->where('companies.id', $company->id);
            });
        }
    }

    // Mutators
    public function setAboutMeAttribute($value)
    {
        $this->attributes['about_me'] = strtoupper($value);
    }
}

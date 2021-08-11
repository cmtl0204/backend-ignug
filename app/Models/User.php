<?php

namespace App\Models;

use App\Traits\EmailTrait;
use App\Traits\FileTrait;
use App\Traits\ImageTrait;
use App\Traits\PhoneTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditing;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements Auditable, MustVerifyEmail
{
    use HasFactory;
    use Auditing;
    use Notifiable;
    use HasApiTokens;
    use SoftDeletes;
    use HasRoles;
    use PhoneTrait;
    use EmailTrait;
    use FileTrait;
    use ImageTrait;

    const MAX_ATTEMPTS = 3;
    const DECAY_MINUTES_PASSWORD_FORGOT = 10;
    const DECAY_MINUTES_USER_UNLOCK = 10;
    const DECAY_MINUTES_TRANSACTIONAL_CODE = 2;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'avatar',
        'username',
        'birthdate',
        'name',
        'lastname',
        'email',
        'email_verified_at',
        'password_changed',
        'max_attempts',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationships
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function phones()
    {
        return $this->morphMany(Phone::class, 'phoneable');
    }

    public function emails()
    {
        return $this->morphMany(Email::class, 'emailable');
    }

    public function identificationType()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function sex()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function gender()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function bloodType()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function ethnicOrigin()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function civilStatus()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }


    // Scopes
    public function scopeUsername($query, $username)
    {
        if ($username) {
            return $query->orWhere('username', 'ILIKE', "%$username%");
        }
    }

    public function scopeName($query, $name)
    {
        if ($name) {
            return $query->orWhere('name', 'ILIKE', "%$name%");
        }
    }

    public function scopeLastname($query, $lastname)
    {
        if ($lastname) {
            return $query->orWhere('lastname', 'ILIKE', "%$lastname%");
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

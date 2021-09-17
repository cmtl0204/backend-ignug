<?php

namespace App\Models\JobBoard;

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
 * @property string employer
 * @property string position
 * @property date start_date
 * @property date end_date
 * @property json activities
 * @property string reason_leave
 * @property boolean is_workign
 */
class Experience extends Model implements Auditable
{
    use HasFactory;
    use Auditing;
    use SoftDeletes;

    protected $table = 'job_board.experiences';

    protected $fillable = [
        'activities',
        'end_date',
        'employer',
        'position',
        'reason_leave',
        'start_date',
        'worked'
    ];

    public function area()
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

    // Mutators
    public function setEmployerAttribute($value)
    {
        $this->attributes['employer'] = strtoupper($value);
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = strtolower($value);
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = strtolower($value);
    }

    public function setPositionAttribute($value)
    {
        $this->attributes['position'] = strtoupper($value);
    }
    
}

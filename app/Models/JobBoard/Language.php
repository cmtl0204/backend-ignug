<?php

namespace App\Models\JobBoard;

use App\Traits\FileTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditing;
use Illuminate\Database\Eloquent\SoftDeletes;
use Brick\Math\BigInteger;
use App\Models\Core\Catalogue;
use App\Models\Core\File;

/**
 * @property BigInteger id
 */
class Language extends Model implements Auditable
{
    use HasFactory;
    use Auditing;
    use SoftDeletes;
    use FileTrait;

    protected $table = 'job_board.languages';

   // Relationships
    public function idiom()
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

    public function read_level()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function spoken_level()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function written_level()
    {
        return $this->belongsTo(Catalogue::class);
    }
}

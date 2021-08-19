<?php

namespace App\Models\JobBoard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditing;

class AcademicFormation extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use Auditing;

    protected $table = 'job_board.academic_formations';

    protected $fillable = [
        'registration_date',
        'senescyt_code',
        'certificated'
    ];

    protected $casts = [
        'registration_date' => 'datetime'
    ];

    public function professional()
    {
        return $this->belongsTo(Professional::class);
    }

    public function professionalDegree()
    {
        return $this->belongsTo(Category::class);
    }

}

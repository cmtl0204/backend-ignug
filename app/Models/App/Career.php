<?php

namespace App\Models\App;

use App\Models\Core\Catalogue;
use App\Models\Uic\Modality;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditing;
use Illuminate\Database\Eloquent\SoftDeletes;

class Career extends Model implements Auditable
{
    use HasFactory;
    use Auditing;
    use SoftDeletes;

    protected static $instance;

    protected $table = 'app.careers';

    protected $fillable = [
        'code',
        'name',
        'description',
        'short_name',
        'resolution_number',
        'title',
        'acronym',
        'logo',
        'learning_results',
        'codigo_sniese',
    ];

    // Instance
    public static function getInstance($id)
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }
        static::$instance->id = $id;
        return static::$instance;
    }

    // Relationships
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function modality()
    {
        return $this->belongsTo(Modality::class);
    }

    public function type()
    {
        return $this->belongsTo(Catalogue::class);
    }
}

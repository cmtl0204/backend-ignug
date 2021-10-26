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

    protected $casts = [
        'learning_results' => 'array',
    ];

   

    // Relationships
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function modalities()
    {
        return $this->belongsToMany(Modality::class);
    }

    public function type()
    {
        return $this->belongsTo(Catalogue::class);
    }
}

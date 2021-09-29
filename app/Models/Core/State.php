<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditing;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model implements Auditable
{
    use HasFactory;
    use Auditing;
    use SoftDeletes;

<<<<<<< HEAD
    protected $table = 'core.status';
=======
    protected $table = 'authentication.states';
>>>>>>> 1ff8bf3648ca800014c8bc17d3bfc6d6093bcf34

    protected $fillable = ['code', 'name'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table = 'projects';
    protected $fillable = ['title', 'description', 'code','approved'];
    // realcion uno a uno 
    function authors(){

        return $this -> hasOne(Author::class)
    }
      
     // realción uno a muchos en el belongs to va las clave foranea
     function authors(){

        return $this -> belongsTo(related: Project::class)
    }


     // realción varios a varios  en el belongs to va las clave foranea
     function authors(){

        return $this -> belongsTo(related: Project::class)
}


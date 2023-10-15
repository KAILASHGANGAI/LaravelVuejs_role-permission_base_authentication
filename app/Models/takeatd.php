<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class takeatd extends Model
{
    use HasFactory;
    protected $table ="takeatds";
    protected $fillable = [
        'staff_id',	
        'faculty_id',	
        'semesters_id',	
        'section_id',	

            ];

    public function attendances()
    {
        return $this->hasMany('App\Models\attendance','createattendances_id','id');
    }
    public function faculty()
    {
        return $this->hasOne('App\Models\faculty','id','faculty_id');
    }
    public function semester()
    {
        return $this->hasOne('App\Models\semester','id','semesters_id');
    }
    public function section() 
    {
        return $this->hasOne('App\Models\section','id','section_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class period extends Model
{
    use HasFactory;
    protected $tabble = 'periods';
    protected $fillable = [
    'faculty_id',
    'semesters_id',
    'section_id',
    'no_of_periods',
    'teachers',
    'subjects',
    'starttimes',
    'endtimes'];
    
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

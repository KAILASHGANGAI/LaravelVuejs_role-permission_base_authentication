<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class exam extends Model
{
    use HasFactory;
    protected $fillable=[
        'faculties_id',	
        'semesters_id',	
        'section_id',	
        'exam_type',	
        'date',	
        'time',	
        'subject',	
        'total_marks',	
        'pass_marks',	
        'one_que_marks',	
        'neg_marks'	
    ];
    public function ques(){
        return $this->hasMany('\App\Models\question');
    }
    public function faculty()
    {
        return $this->hasOne('App\Models\faculty','id','faculty_id');
    }
    public function semester()
    {
        return $this->hasOne('App\Models\semester','id','semester_id');
    }
    public function section()
    {
        return $this->hasOne('App\Models\section','id','section_id');
    }
    public function marks()
    {
        return $this->hasmany('App\Models\marks','exam_id','id');
    }

}

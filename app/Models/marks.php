<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class marks extends Model
{
    use HasFactory;
    protected $fillable = ['exam_id','student_id','subject_id','marks'];
    public function student()
    {
        return $this->hasOne('App\Models\students','id','student_id');
    }
    public function subject()
    {
        return $this->hasOne('App\Models\subjects','id','subject_id');
    }
    public function exam()
    {
        return $this->hasOne('App\Models\exam','id','exam_id');
    }
}

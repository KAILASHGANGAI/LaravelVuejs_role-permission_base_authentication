<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attendance extends Model
{
    use HasFactory;

    protected $fillable = [

        'createattendances_id',
        'students_id', 'faculty_id', 'semesters_id', 'section_id', 'date'
    ];

    public function students()
    {
        return $this->belongsTo('App\Models\students', 'students_id', 'id');
    }
}

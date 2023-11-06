<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assignment extends Model
{
    use HasFactory;

    protected $fillable = [

        'subject',
        'faculty_id',
        'sections_id',
        'semesters_id',
        'teachers_id',
        'topic',
        'file_path',
        'deadline'];

    public function faculty()
    {
        return $this->hasOne('App\Models\faculty', 'id', 'faculty_id');
    }

    public function semester()
    {
        return $this->hasOne('App\Models\semester', 'id', 'semesters_id');
    }

    public function section()
    {
        return $this->hasOne('App\Models\section', 'id', 'sections_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\user', 'id', 'teachers_id');
    }
}

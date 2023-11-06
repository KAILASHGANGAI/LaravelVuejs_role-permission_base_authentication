<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class note extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject'.
        'faculty_id',
        'semesters_id',
        'teachers_id',
        'topic',
        'file_path',
    ];

    public function faculty()
    {
        return $this->hasOne('App\Models\faculty', 'id', 'faculty_id');
    }

    public function semester()
    {
        return $this->hasOne('App\Models\semester', 'id', 'semesters_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\user', 'id', 'teachers_id');
    }
}

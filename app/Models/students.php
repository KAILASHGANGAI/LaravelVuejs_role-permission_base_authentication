<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class students extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'name',
        'address',
        'phone_no',
        'DOB',
        'email',
        'password',
        'faculty',
        'semester_yrs',
        'blood_group',
        'gender',
        'nationality',
        'tuitionfee',
        'image',
        'user_id',
    ];

    public function guardian()
    {
        return $this->hasOne('App\Models\guardian');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\payment');
    }

    public function libreary()
    {
        return $this->hasMany('App\Models\bookstaken');
    }

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
        return $this->hasOne('App\Models\section', 'id', 'section_id');
    }

    public function blood()
    {
        return $this->hasOne('App\Models\blood_group', 'id', 'blood_group');
    }

    public function payment()
    {
        return $this->hasMany('App\Models\payment', 'students_id', 'id');
    }

    public function marks()
    {
        return $this->hasMany('App\Models\marks', 'student_id', 'id');
    }

    public function attendance()
    {
        return $this->hasMany(attendance::class);
    }
}

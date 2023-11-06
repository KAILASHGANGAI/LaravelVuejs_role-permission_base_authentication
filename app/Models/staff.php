<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'contact',
        'email',
        'password',
        'staff_category',
        'gender',
        'salary',
        'bloodgroup',
        'dob',
        'experience',
        'education',
        'images',
        'user_id',

    ];

    public function attendance(): HasMany
    {
        return $this->hasMany(teacherAttendance::class, 'staff_id', 'id');
    }
}

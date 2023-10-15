<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class staff extends Model
{
    use HasFactory;
protected $fillable =[
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
    'images'


];
}

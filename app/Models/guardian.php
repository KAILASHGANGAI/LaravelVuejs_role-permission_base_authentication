<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guardian extends Model
{
    use HasFactory;
    protected $fillable = [
    	
        'students_id',	
        'name',	
        'address',	
        'phone_no',	
        'email'.	
        'password',	
        'image',	
    ];
}

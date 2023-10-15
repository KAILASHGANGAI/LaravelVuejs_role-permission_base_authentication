<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blood_group extends Model
{
    use HasFactory;
    protected $table = 'blood_groups';
    protected $fillable = [
        'blood_groups'

    ];
}

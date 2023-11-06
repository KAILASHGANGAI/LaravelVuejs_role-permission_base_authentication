<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ownerDetails extends Model
{
    use HasFactory;

    protected $table = 'owner_details';

    protected $fillable = ['school_name', 'phone', 'email', 'address', 'pan_number', 'logo'];
}

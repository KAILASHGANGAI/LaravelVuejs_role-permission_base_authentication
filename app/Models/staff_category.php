<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class staff_category extends Model
{
    use HasFactory;
    protected $table = 'staff_categories';
    protected $fillable = ['category_name'];
}

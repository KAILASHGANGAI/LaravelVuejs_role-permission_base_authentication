<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class libreary extends Model
{
    use HasFactory;

    protected $fillable = [

        'students_id',
        'librearies_id',
        'book_code',

    ];

    public function faculty()
    {
        return $this->hasOne('App\Models\faculty', 'id', 'faculty');
    }

    public function semester()
    {
        return $this->hasOne('App\Models\semester', 'id', 'semester');
    }
}

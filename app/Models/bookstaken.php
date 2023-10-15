<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bookstaken extends Model
{
    use HasFactory;
    protected $fillable = ['students_id	','librearies_id','book_code'];
    public function books()
    {
        return $this->belongsTo('App\Models\libreary','librearies_id','id');
    }
}

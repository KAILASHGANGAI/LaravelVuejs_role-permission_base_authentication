<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subjects extends Model
{
    use HasFactory;
    protected $fillable = ['subjects','subjects_code','fullmarks','passmarks','practal_fullmarks','practical_passmarks'];
    public function faculty()
    {
        return $this->hasOne('App\Models\faculty','id','faculty_id');
    }
    public function semester()
    {
        return $this->hasOne('App\Models\semester','id','semester_id');
    }
}

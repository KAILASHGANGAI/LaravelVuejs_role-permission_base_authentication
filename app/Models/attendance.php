<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attendance extends Model
{
    use HasFactory;

    protected $fillable = [

        'createattendances_id',
        'students_id'];

    public function students()
    {
        return $this->hasOne('App\Models\students', 'id', 'students_id');

    }
}

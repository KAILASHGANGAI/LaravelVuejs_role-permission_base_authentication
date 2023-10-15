<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'students_id',	
        'deposited',	
        'discount',	
        'payment_method',	
        'fee_type'
    ];

        public function students()
        {
            return $this->hasOne('App\Models\students','id','students_id');
        }
}

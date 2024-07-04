<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveManagement extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'leave_management';

    protected $fillable = [
        'student_id',
        'start_date',
        'end_date',
        'leave_type',
        'leave_days',
        'reason',
        'status',
        'approved_by',
        'decline_by',
        'decline_reason',
        'decline_by_name'

    ];
}

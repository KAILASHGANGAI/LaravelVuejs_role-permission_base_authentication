<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherLeaveManagement extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'teacher_leave_management';

    protected $fillable = [
        'staff_id',
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

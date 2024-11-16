<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'mobile',
        'email',
        'department_id',
        'status',
    ];
}

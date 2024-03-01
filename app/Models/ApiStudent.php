<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiStudent extends Model
{
    use HasFactory;
    protected $table = 'api_students';
    // protected $primaryKey = 'student_id';
}

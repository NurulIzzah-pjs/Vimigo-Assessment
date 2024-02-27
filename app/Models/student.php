<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'address', 'study_course'];
    protected $hidden = ['created_at', 'updated_at'];
}

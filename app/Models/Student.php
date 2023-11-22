<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    const Active = 1;

    const IsActive = 0;

    protected $fillable = [
        'name',
        'code',
        'date_of_birth',
        'img',
        'is_active',
    ];
}

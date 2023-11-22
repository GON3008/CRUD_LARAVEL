<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const Active = 1;

    const IsActive = 0;

    protected $fillable = [
        'name',
        'price',
        'price_sale',
        'img',
        'description',
        'is_active',
    ];
}

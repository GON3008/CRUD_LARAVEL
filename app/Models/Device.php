<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;


    const Active = 1;

    const IsActive = 0;

    protected $fillable = [
        'category_id',
        'name',
        'serial',
        'model',
        'img',
        'description',
        'is_active',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

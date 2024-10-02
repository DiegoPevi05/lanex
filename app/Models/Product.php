<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'stars',
        'description',
        'EAN'
    ];

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class);
    }
}

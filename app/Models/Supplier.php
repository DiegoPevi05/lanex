<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'description',
        'details'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
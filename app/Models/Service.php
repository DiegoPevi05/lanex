<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_id',
        'name',
        'icon',
        'short_description',
        'webcontent'
    ];

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class);
    }
}

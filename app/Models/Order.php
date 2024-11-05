<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'order_number',
        'status',
        'details',
        'net_amount',
        'taxes',
        'operative_cost',
        'numero_dam',
        'manifest',
        'channel',
        'client_id'
    ];

    public function freights()
    {
        return $this->hasMany(Freight::class, 'order_id'); // One-to-many relationship
    }

    public function trackingSteps()
    {
        return $this->hasMany(TrackingStep::class,'order_id'); // One-to-many relationship with tracking steps
    }

}

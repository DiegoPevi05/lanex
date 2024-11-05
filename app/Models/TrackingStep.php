<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingStep extends Model
{
    use HasFactory;

    protected $table = 'tracking_steps';

    protected $fillable = [
        'status',
        'sequence',
        'origin',
        'destination'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id'); // Each tracking step belongs to one order
    }

    public function transportType()
    {
        return $this->belongsTo(TransportType::class, 'transport_type_id');
    };

}

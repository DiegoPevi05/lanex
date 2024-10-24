<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'charge',
        'date_review',
        'review',
        'stars',
    ];

    public function getType(): string
    {
        return 'Review';
    }

    /**
     * Serialize the Review model into a JSON string.
     *
     * @return string
     */
    public function serialize(): string
    {
        return json_encode([
            'name' => $this->name,
            'charge' => $this->charge,
            'date_review' => $this->date_review,
            'review' => $this->review,
            'stars' => $this->stars,
        ]);
    }

    /**
     * Deserialize a JSON string into a Review object.
     *
     * @param string $json
     * @return Review
     */
    public static function deserialize(string $json): Review
    {
        $data = json_decode($json, true);

        // Create a new Review instance with the deserialized data
        return new self([
            'name' => $data['name'],
            'charge' => $data['charge'],
            'date_review' => $data['date_review'],
            'review' => $data['review'],
            'stars' => $data['stars'],
        ]);
    }
}

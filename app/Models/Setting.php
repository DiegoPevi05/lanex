<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'group',
    ];

    /**
     * Get a setting by key, with optional default fallback.
     */
    public static function get(string $key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        if ($setting && $setting->value !== null && $setting->value !== '') {
            return $setting->value;
        }

        return $default;
    }

    /**
     * Set a setting value by key.
     */
    public static function set(string $key, $value, string $group = 'notifications'): self
    {
        return static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group]
        );
    }

    /**
     * Get one or multiple email addresses from a setting key.
     * Supports single email or comma-separated lists (e.g. "ventas@lanex.pe, operaciones@lanex.pe").
     *
     * @return array<int, string>
     */
    public static function getEmails(string $key, $default = null): array
    {
        $raw = static::get($key, $default);
        if (!$raw) {
            return [];
        }

        $parts = preg_split('/[,;\s]+/', (string) $raw, -1, PREG_SPLIT_NO_EMPTY);
        $validEmails = [];
        foreach ($parts as $email) {
            $trimmed = trim($email);
            if (filter_var($trimmed, FILTER_VALIDATE_EMAIL)) {
                $validEmails[] = $trimmed;
            }
        }

        return array_values(array_unique($validEmails));
    }
}

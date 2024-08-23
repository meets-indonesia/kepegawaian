<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class PendingAction
{
    /**
     * Save a pending action to Redis.
     */
    public static function savePendingAction($type, $id, $data)
    {
        $key = "pending_{$type}:{$id}";
        Redis::set($key, json_encode($data));
        Redis::persist($key); // Ensure the key persists indefinitely
    }

    /**
     * Get all pending actions of a certain type.
     */
    public static function getPendingActions($type)
    {
        $keys = Redis::keys("pending_{$type}:*");
        Log::info('Keys:', $keys);

        $actions = [];
        foreach ($keys as $key) {
            // Remove any prefix if necessary
            $formattedKey = str_replace('laravel_database_', '', $key);

            $exists = Redis::command('EXISTS', [$formattedKey]);
            Log::info('Key exists:', ['key' => $formattedKey, 'exists' => $exists > 0]);

            if ($exists > 0) {
                $data = Redis::get($formattedKey);
                Log::info('Raw data from Redis:', ['key' => $formattedKey, 'data' => $data]);

                if ($data !== null) {
                    $decoded = json_decode($data, true);
                    if (json_last_error() === JSON_ERROR_NONE) {
                        $actions[] = $decoded;
                    } else {
                        Log::error('JSON decoding error:', ['key' => $formattedKey, 'error' => json_last_error_msg()]);
                    }
                }
            }
        }
        Log::info('Actions array:', $actions);
        return $actions;
    }


    /**
     * Get a specific pending action by type and ID.
     */
    public static function getPendingAction($type, $id)
    {
        $key = "pending_{$type}:{$id}";
        return json_decode(Redis::get($key), true);
    }

    /**
     * Delete a pending action by type and ID.
     */
    public static function deletePendingAction($type, $id)
    {
        $key = "pending_{$type}:{$id}";
        Redis::del($key);
    }
}

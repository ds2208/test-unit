<?php

namespace App\Lib;

use Illuminate\Support\Facades\Cache;
use App\Models\Color;

class CachedEntities
{
    public static function aColors()
    {
        $cacheToken = make_cache_token('available_colors');

        return Cache::rememberForever(
            $cacheToken,
            function () use ($cacheToken) {
                $colors = Color::active()->get();
                CacheManagement::updateDB($cacheToken, [
                    (new Color())->getTable()
                ]);
                return $colors;
            }
        );
    }
}
<?php

namespace App\Helpers;

class Helpers
{
    public static function uasset(string $path = '')
    {
        if (request()->secure()) {
            return secure_asset($path);
        }

        return asset($path);
    }
}


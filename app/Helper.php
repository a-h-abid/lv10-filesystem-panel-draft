<?php

namespace App;

use App\Models\User;

class Helper
{
    public static function storageDirectoryPrefix(User $user)
    {
        return $user->id . '/';
    }

    public static function fileSizeBytesToHuman($bytes = 0)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
}

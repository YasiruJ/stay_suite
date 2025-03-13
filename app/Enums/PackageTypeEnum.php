<?php

namespace App\Enums;

enum PackageTypeEnum
{
    const MONTHLY = 0;
    const YEARLY = 1;
    // const URGENT = 2;

    public static function values(): array
    {
        return [
            self::MONTHLY => 'MONTHLY',
            self::YEARLY => 'YEARLY',
        ];
    }

    public static function getAll(): array
    {
        return array_map(
            fn($key, $value) => ['value' => $key, 'name' => $value],
            array_keys(self::values()),
            self::values()
        );
    }
}

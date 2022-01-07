<?php

namespace App\ddd\Domain\ValueObject;

use App\ddd\Infrastructure\Service\ReflectionService;

abstract class ValueObject
{
    public static function allValues(): array
    {
        return ReflectionService::getConstants(static::class);
    }

}
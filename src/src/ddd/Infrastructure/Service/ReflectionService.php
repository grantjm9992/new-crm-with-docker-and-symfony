<?php

namespace App\ddd\Infrastructure\Service;

use ReflectionClass;
use ReflectionException;

class ReflectionService
{
    /**
     * @throws ReflectionException
     */
    public static function getConstants(string $className): array
    {
        return (new ReflectionClass($className))->getConstants();
    }
}
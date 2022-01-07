<?php

namespace App\ddd\Infrastructure\QueryParams;

class QueryParamOperators
{
    public const LIKE = 'like';
    public const GREATER_THAN = 'gt';
    public const LESS_THAN = 'lt';
    public const GREATER_THAN_OR_EQUAL_TO = 'gte';
    public const LESS_THAN_OR_EQUAL_TO = 'lte';

    public static function buildString(string $operator, string $alias, string $field): string
    {
        switch ($operator) {
            case 'like':
                return self::like($alias, $field);
            default:
                return '';
        }
    }

    protected static function like(string $alias, string $field): string
    {
        return "$alias.$field LIKE :$field";
    }
}
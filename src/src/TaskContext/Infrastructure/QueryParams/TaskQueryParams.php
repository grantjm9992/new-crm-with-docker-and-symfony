<?php

namespace App\TaskContext\Infrastructure\QueryParams;

use App\ddd\Infrastructure\QueryParams\BaseQueryParams;
use App\ddd\Infrastructure\QueryParams\QueryParamOperators;

class TaskQueryParams extends BaseQueryParams
{
    public const TITLE = 'title';
    public const DESCRIPTION = 'description';

    public static function build(array $queryParams): BaseQueryParams
    {
        return parent::build($queryParams);
    }

    protected function map(): array
    {
        return [
            self::TITLE => 'title',
            self::DESCRIPTION => 'description'
        ];
    }

    protected function nullable(): array
    {
        return [
            self::TITLE
        ];
    }

    protected function operators(): array
    {
        return [
            self::TITLE => QueryParamOperators::LIKE
        ];
    }
}
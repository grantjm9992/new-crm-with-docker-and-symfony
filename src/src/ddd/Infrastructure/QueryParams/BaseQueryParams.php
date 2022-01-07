<?php

namespace App\ddd\Infrastructure\QueryParams;

abstract class BaseQueryParams
{
    public const ORDER_KEY = 'orderBy';
    public const ORDER_TYPE = 'orderType';
    public const PAGE = 'page';
    public const PAGE_SIZE = 'pageSize';

    private array $queryParams;
    private string $alias;
    private string $orderKey;
    private string $orderTypeKey;
    private string $order;
    private string $orderType;
    private int $page;
    private int $pageSize;
    private string $pageKey;
    private string $pageSizeKey;

    private array $nullable;
    private array $operators;

    public function __construct(array $queryParams)
    {
        $this->queryParams = $queryParams;
        $this->alias = $this->alias();
        $this->nullable = $this->nullable();
        $this->operators = $this->operators();
        $this->mapQueryParams();
    }

    public static function build(array $queryParams): BaseQueryParams
    {
        return new static(
            $queryParams
        );
    }

    abstract protected function map();

    protected function operators(): array
    {
        return [];
    }

    final protected function mapQueryParams()
    {
        $finalParams = [];
        $mappedFields = $this->map();
        $operators = $this->getOperators();
        foreach ($this->queryParams as $key => $value) {
            if (array_key_exists($key, $mappedFields)) {
                if (!is_array($value)) {
                    $finalParams[$mappedFields[$key]] = $value;
                    continue;
                }

                foreach ($value as $secondKey => $secondValue) {
                    if (array_key_exists($key, $operators) && $operators[$key] == $secondKey) {
                        $finalParams[$mappedFields[$key]] = $value;
                    }
                }
            }
        }
        $this->queryParams = $finalParams;
    }

    protected function alias(): string
    {
        return 'table_';
    }

    protected function nullable(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    /**
     * @return string
     */
    public function getOrderKey(): string
    {
        return $this->orderKey;
    }

    /**
     * @return string
     */
    public function getOrderTypeKey(): string
    {
        return $this->orderTypeKey;
    }

    /**
     * @return string
     */
    public function getOrder(): string
    {
        return $this->order;
    }

    /**
     * @return string
     */
    public function getOrderType(): string
    {
        return $this->orderType;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    /**
     * @return string
     */
    public function getPageKey(): string
    {
        return $this->pageKey;
    }

    /**
     * @return string
     */
    public function getPageSizeKey(): string
    {
        return $this->pageSizeKey;
    }

    /**
     * @return array
     */
    public function getNullable(): array
    {
        return $this->nullable;
    }

    /**
     * @return array
     */
    public function getOperators(): array
    {
        return $this->operators;
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }

}
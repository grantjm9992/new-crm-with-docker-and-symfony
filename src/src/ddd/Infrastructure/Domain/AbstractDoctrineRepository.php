<?php

namespace App\ddd\Infrastructure\Domain;

use App\ddd\Domain\Model\AbstractRepository;
use App\ddd\Infrastructure\QueryParams\BaseQueryParams;
use App\ddd\Infrastructure\QueryParams\QueryParamOperators;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

abstract class AbstractDoctrineRepository extends ServiceEntityRepository implements AbstractRepository
{
    // TODO - Add Pagination
    public function __construct(ManagerRegistry $registry, string $entityClass)
    {
        parent::__construct($registry, $entityClass);
    }

    public function queryBuilderList(string $alias, string $companyId): QueryBuilder
    {
        return $this->createQueryBuilder($alias)
            ->andWhere("$alias.companyId IS NULL OR $alias.companyId = :companyId")
            ->setParameter('companyId', $companyId);
    }

    public function all(string $alias): array
    {
        return $this->createQueryBuilder($alias)
            ->getQuery()
            ->getResult();
    }

    public function filter(BaseQueryParams $queryParams): QueryBuilder
    {
        $alias = $queryParams->getAlias();
        $queryBuilder = $this->createQueryBuilder($alias);
        foreach ($queryParams->getQueryParams() as $key => $value) {
            if (is_array($value)) {
                $filterString = '';
                $realValue = null;
                foreach ($value as $operator => $equalTo) {
                    $filterString = QueryParamOperators::buildString($operator, $alias, $key);
                    $realValue = $equalTo;
                    if ($operator == QueryParamOperators::LIKE) {
                        $realValue = "%$equalTo%";
                    }
                }
                if (in_array($key, $queryParams->getNullable())) {
                    $filterString .= " OR $alias.$key IS NULL";
                }
                $queryBuilder->andWhere($filterString)
                    ->setParameter($key, $realValue);
                continue;
            }
            $filterString = "$alias.$key = :$key";
            if (in_array($key, $queryParams->getNullable())) {
                $filterString .= " OR $alias.$key IS NULL";
            }
            $queryBuilder->andWhere($filterString)
                ->setParameter($key, $value);
        }

        return $queryBuilder;
    }
}
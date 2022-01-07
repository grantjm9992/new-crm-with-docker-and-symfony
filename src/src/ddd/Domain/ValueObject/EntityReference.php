<?php

namespace App\ddd\Domain\ValueObject;

use Exception;
use Ramsey\Uuid\Uuid;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class EntityReference extends ValueObject
{
    public const TASK = 'task';
    public const CONTACT = 'contact';
    public const USER = 'user';
    public const COMPANY = 'company';

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private string $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private string $type;

    public function __construct(string $id, string $type)
    {
        self::validate($id, $type);

        $this->id = $id;
        $this->type = $type;
    }

    public static function validate($id, $type): void
    {
        if (!Uuid::isValid($id)) {
            throw new Exception('Invalid UUID');
        }

        if (!in_array($type, self::allValues(), true)) {
            throw new Exception('Invalid entity reference type');
        }
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
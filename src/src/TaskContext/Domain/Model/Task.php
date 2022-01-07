<?php

namespace App\TaskContext\Domain\Model;

use App\CoreContext\Domain\Model\Company;
use App\CoreContext\Domain\Model\User;
use App\ddd\Domain\ValueObject\EntityReference;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity(repositoryClass=TaskDoctrineRepository::class)
 */
class Task
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=255)
     */
    private string $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\TaskContext\Domain\Model\TaskStatus")
     */
    private TaskStatus $taskStatus;

    /**
     * @ORM\ManyToOne(targetEntity="App\CoreContext\Domain\Model\User")
     */
    private User $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\CoreContext\Domain\Model\Company")
     */
    private Company $company;

    /**
     * @ORM\Embedded(class="App\ddd\Domain\ValueObject\EntityReference", columnPrefix="entity_reference_", nullable=true)
     */
    private ?EntityReference $entityReference;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private string $notes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $orden;

    /**
     * @var datetime $createdAt
     *
     * @ORM\Column(type="datetime")
     */
    protected DateTime $createdAt;

    /**
     * @var datetime $updatedAt
     *
     * @ORM\Column(type="datetime", nullable = true)
     */
    protected datetime $updatedAt;

    public function __construct(
        string $title,
        ?string $description,
        TaskStatus $taskStatus,
        User $user,
        Company $company,
        ?EntityReference $entityReference,
        string $notes,
        ?int $orden
    )
    {
        $this->id = Uuid::uuid4()->toString();

        $this->title = $title;
        $this->description = $description;
        $this->taskStatus = $taskStatus;
        $this->user = $user;
        $this->company = $company;
        $this->entityReference = $entityReference;
        $this->notes = $notes;
        $this->orden = $orden;

        $this->createdAt = new DateTime('now');
        $this->updatedAt = new DateTime('now');
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return TaskStatus
     */
    public function getTaskStatus(): TaskStatus
    {
        return $this->taskStatus;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return Company
     */
    public function getCompany(): Company
    {
        return $this->company;
    }

    /**
     * @return EntityReference|null
     */
    public function getEntityReference(): ?EntityReference
    {
        return $this->entityReference;
    }

    /**
     * @return string|null
     */
    public function getNotes(): ?string
    {
        return $this->notes;
    }

    /**
     * @return int|null
     */
    public function getOrden(): ?int
    {
        return $this->orden;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }
}
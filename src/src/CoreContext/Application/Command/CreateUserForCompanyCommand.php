<?php

namespace App\CoreContext\Application\Command;

use App\ddd\CQRS\Command\Command;

class CreateUserForCompanyCommand implements Command
{
    private string $companyId;
    private string $name;
    private string $surname;
    private ?string $secondSurname;
    private string $email;
    private string $password;
    private ?string $phone;
    private ?string $mobile;

    public function __construct(
        string $companyId,
        string $name,
        string $surname,
        ?string $secondSurname,
        string $email,
        string $password,
        ?string $phone,
        ?string $mobile
    )
    {
        $this->companyId = $companyId;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
        $this->secondSurname = $secondSurname;
        $this->phone = $phone;
        $this->mobile = $mobile;
    }

    /**
     * @return string
     */
    public function getCompanyId(): string
    {
        return $this->companyId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return string|null
     */
    public function getSecondSurname(): ?string
    {
        return $this->secondSurname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @return string|null
     */
    public function getMobile(): ?string
    {
        return $this->mobile;
    }
}
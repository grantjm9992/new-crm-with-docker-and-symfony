<?php

namespace App\CoreContext\Application\Command;

use App\CoreContext\Domain\Event\UserCreatedEvent;
use App\CoreContext\Domain\Model\CompanyRepository;
use App\CoreContext\Domain\Model\Role;
use App\CoreContext\Domain\Model\RoleRepository;
use App\CoreContext\Domain\Model\User;
use App\CoreContext\Domain\Model\UserRepository;
use App\ddd\CQRS\Command\CommandHandler;
use App\ddd\Domain\Event\EventPublisher;
use Symfony\Component\Config\Definition\Exception\DuplicateKeyException;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class CreateUserForCompanyCommandHandler implements CommandHandler
{
    private UserRepository $userRepository;
    private CreateCompanyCommandHandler $createCompanyCommandHandler;
    private RoleRepository $roleRepository;
    private EventDispatcherInterface $dispatcher;
    private CompanyRepository $companyRepository;

    public function __construct(
        UserRepository $userRepository,
        CreateCompanyCommandHandler $createCompanyCommandHandler,
        CompanyRepository $companyRepository,
        RoleRepository $roleRepository,
        EventDispatcherInterface $dispatcher
    )
    {
        $this->userRepository = $userRepository;
        $this->createCompanyCommandHandler = $createCompanyCommandHandler;
        $this->roleRepository = $roleRepository;
        $this->dispatcher = $dispatcher;
        $this->companyRepository = $companyRepository;
    }

    public function __invoke(CreateUserForCompanyCommand $command): User
    {
        $existingUser = $this->userRepository->byEmail($command->getEmail());

        if ($existingUser !== null) {
            throw new DuplicateKeyException($existingUser->getId());
        }

        $user = new User(
            $command->getName(),
            $command->getSurname(),
            $command->getSecondSurname(),
            $command->getEmail(),
            $command->getPassword(),
            $command->getPhone(),
            $command->getMobile(),
            null
        );

        $this->userRepository->save($user);

        $company = $this->companyRepository->byId($command->getCompanyId());

        $user->setCompany($company);

        $role = $this->roleRepository->byName($command->getRole() ?? Role::ADMIN);

        $user->updateRole($role);

        $this->userRepository->save($user);

        // THIS IS HOW: $this->dispatcher->dispatch(new UserCreatedEvent($user->getId()), 'UserCreatedEvent');

        return $user;
    }
}
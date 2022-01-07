<?php

namespace App\CoreContext\Application\Command;

use App\CoreContext\Domain\Event\UserCreatedEvent;
use App\CoreContext\Domain\Model\Role;
use App\CoreContext\Domain\Model\RoleRepository;
use App\CoreContext\Domain\Model\User;
use App\CoreContext\Domain\Model\UserRepository;
use App\ddd\CQRS\Command\CommandHandler;
use App\ddd\Domain\Event\EventPublisher;
use Symfony\Component\Config\Definition\Exception\DuplicateKeyException;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class CreateUserCommandHandler implements CommandHandler
{
    private UserRepository $userRepository;
    private CreateCompanyCommandHandler $createCompanyCommandHandler;
    private RoleRepository $roleRepository;
    private EventDispatcherInterface $dispatcher;

    public function __construct(
        UserRepository $userRepository,
        CreateCompanyCommandHandler $createCompanyCommandHandler,
        RoleRepository $roleRepository,
        EventDispatcherInterface $dispatcher
    )
    {
        $this->userRepository = $userRepository;
        $this->createCompanyCommandHandler = $createCompanyCommandHandler;
        $this->roleRepository = $roleRepository;
        $this->dispatcher = $dispatcher;
    }

    public function __invoke(CreateUserCommand $command): User
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
            $command->getCompanyName()
        );

        $this->userRepository->save($user);

        $company = $this->createCompanyCommandHandler->__invoke(
            new CreateCompanyCommand(
                $command->getCompanyName(),
                $user->getEmail(),
                null
            )
        );

        $user->setCompany($company);

        $role = $this->roleRepository->byName(Role::ADMIN);

        $user->updateRole($role);

        $this->userRepository->save($user);

        // THIS IS HOW: $this->dispatcher->dispatch(new UserCreatedEvent($user->getId()), 'UserCreatedEvent');

        return $user;
    }
}
<?php
declare(strict_types=1);

namespace App\Handler;

use App\Message\UserCreate;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class UserCreateHandler
{
    public function __construct(
        private readonly LoggerInterface $logger,
    ) {}

    public function __invoke(UserCreate $userCreate): void
    {
        $newUserData = $userCreate->getUserData();

        $this->logger->warning('NOTIFICATIONSSERVICE: {USER_CREATE} - '.$newUserData);
        
        ## business logic, i.e. sending internal notification or queueing some other systems
    }
}
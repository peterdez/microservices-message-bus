<?php
declare(strict_types=1);
namespace App\Message;

class UserCreate
{
    public function __construct(protected string $userData){}

    public function getUserData(): string
    {
        return $this->userData;
    }
}
<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

/*use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
*/

class UserTest extends TestCase
{
  public function testCanGetAndSetData() : void {

    $user = new User();
    $user->setEmail('bola@gmail.com');
    $user->setFirstName('Bola');
    $user->setLastName('Banji');

    self::assertSame(expected:'bola@gmail.com', actual: $user->getEmail());
    self::assertSame(expected:'Bola', actual: $user->getFirstName());
    self::assertSame(expected:'Banji', actual: $user->getLastName()); 
  } 
}
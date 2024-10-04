<?php

declare(strict_types=1);

namespace Tests\Infrastructure\Persistence\User;

use App\Domain\User\User;
use App\Domain\User\UserNotFoundException;
use App\Infrastructure\Persistence\User\InMemoryUserRepository;
use Tests\TestCase;

class InMemoryUserRepositoryTest extends TestCase
{
    public function testFindAll()
    {
        $user = new User(1, 'Bill Gates', 'bill@microsoft.com', 3);

        $userRepository = new InMemoryUserRepository([1 => $user]);

        $this->assertEquals([$user], $userRepository->findAll());
    }

    public function testFindAllUsersByDefault()
    {
        $users = [
            1 => new User(1, 'Bill Gates', 'bill@microsoft.com', 3),
            2 => new User(2, 'Steve Jobs', 'steve@apple.com', 14),
            3 => new User(3, 'Mark Zuckerberg', 'mark@facebook.com', 1),
            4 => new User(4, 'Jack Dorsey', 'jack@twitter.com', 5),
            5 => new User(5, 'David Cochrum', 'david@chrum.me', 999),
        ];

        $userRepository = new InMemoryUserRepository();

        $this->assertEquals(array_values($users), $userRepository->findAll());
    }

    public function testFindUserOfId()
    {
        $user = new User(1, 'Bill Gates', 'bill@microsoft.com', 3);

        $userRepository = new InMemoryUserRepository([1 => $user]);

        $this->assertEquals($user, $userRepository->findUserOfId(1));
    }

    public function testFindUserOfIdThrowsNotFoundException()
    {
        $userRepository = new InMemoryUserRepository([]);
        $this->expectException(UserNotFoundException::class);
        $userRepository->findUserOfId(1);
    }
}

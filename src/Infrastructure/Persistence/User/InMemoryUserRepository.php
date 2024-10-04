<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\User;

use App\Domain\User\User;
use App\Domain\User\UserNotFoundException;
use App\Domain\User\UserRepository;

class InMemoryUserRepository implements UserRepository
{
    /**
     * @var User[]
     */
    private array $users;

    /**
     * @param User[]|null $users
     */
    public function __construct(array $users = null)
    {
        $this->users = $users ?? [
            1 => new User(1, 'Bill Gates', 'bill@microsoft.com', 3),
            2 => new User(2, 'Steve Jobs', 'steve@apple.com', 14),
            3 => new User(3, 'Mark Zuckerberg', 'mark@facebook.com', 1),
            4 => new User(4, 'Jack Dorsey', 'jack@twitter.com', 5),
            5 => new User(5, 'David Cochrum', 'david@chrum.me', 999),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        return array_values($this->users);
    }

    /**
     * {@inheritdoc}
     */
    public function findUserOfId(int $id): User
    {
        if (!isset($this->users[$id])) {
            throw new UserNotFoundException();
        }

        return $this->users[$id];
    }

    /**
     * {@inheritDoc}
     */
    public function create(string $name, string $email): User
    {
        $id = max(array_keys($this->users)) + 1;
        $user = new User($id, $name, $email);
        $this->users[$id] = $user;

        return $user;
    }

    public function update(User $user): void
    {
        $this->users[$user->getId()] = $user;
    }
}

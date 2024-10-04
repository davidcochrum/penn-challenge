<?php

declare(strict_types=1);

namespace App\Domain\User;

interface UserRepository
{
    /**
     * @return User[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    public function findUserOfId(int $id): User;

    /**
     * Creates and persists a User record.
     */
    public function create(string $name, string $email): User;

    /**
     * Updates a User record.
     */
    public function update(User $user): void;

    /**
     * Deletes a User record.
     */
    public function delete(User $user): void;
}

<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\User;

use App\Domain\User\User;
use App\Domain\User\UserNotFoundException;
use App\Domain\User\UserRepository;
use PDO;

class PDOUserRepository implements UserRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        $rows = (array) $this->connection->query('SELECT * FROM users', PDO::FETCH_ASSOC)->fetchAll();

        return array_map([$this, 'modelFromRow'], $rows);
    }

    /**
     * {@inheritdoc}
     */
    public function findUserOfId(int $id): User
    {
        $stmt = $this->connection->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->bindParam('id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            throw new UserNotFoundException();
        }

        return $this->modelFromRow($row);
    }

    public function create(string $name, string $email): User
    {
        $stmt = $this->connection->prepare('
            INSERT INTO users (name, email)
                 VALUES (:name, :email)
              RETURNING id
        ');
        $stmt->bindParam('name', $name);
        $stmt->bindParam('email', $email);
        $stmt->execute();
        $id = $stmt->fetchColumn();

        return $this->findUserOfId($id);
    }

    public function update(User $user): void
    {
        $stmt = $this->connection->prepare('
            UPDATE users
               SET name = :name
                 , email = :email
                 , points_balance = :points_balance
             WHERE id = :id
        ');
        $id = $user->getId();
        $stmt->bindParam('id', $id);
        $name = $user->getName();
        $stmt->bindParam('name', $name);
        $email = $user->getEmail();
        $stmt->bindParam('email', $email);
        $pointsBalance = $user->getPointsBalance();
        $stmt->bindParam('points_balance', $pointsBalance);
        $stmt->execute();
    }

    private function modelFromRow(array $row): User
    {
        return new User($row['id'], $row['name'], $row['email'], $row['points_balance']);
    }
}

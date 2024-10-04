<?php

declare(strict_types=1);

namespace App\Domain\User;

use JsonSerializable;

class User implements JsonSerializable
{
    public function __construct(
        private ?int $id,
        private string $name,
        private string $email,
        private int $pointsBalance = 0
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPointsBalance(): int
    {
        return $this->pointsBalance;
    }

    public function addPoints(int $points): void
    {
        $this->pointsBalance += $points;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'pointsBalance' => $this->pointsBalance,
        ];
    }
}

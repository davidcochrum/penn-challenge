<?php

declare(strict_types=1);

namespace Tests\Domain\User;

use App\Domain\User\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function userProvider(): array
    {
        return [
            [1, 'Bill Gates', 'bill@microsoft.com', 3],
            [2, 'Steve Jobs', 'steve@apple.com', 14],
            [3, 'Mark Zuckerberg', 'mark@facebook.com', 1],
            [4, 'Jack Dorsey', 'jack@twitter.com', 5],
            [5, 'David Cochrum', 'david@chrum.me', 999],
        ];
    }

    /**
     * @dataProvider userProvider
     * @param int    $id
     * @param string $name
     * @param string $email
     * @param string $lastName
     */
    public function testGetters(int $id, string $name, string $email, int $pointsBalance)
    {
        $user = new User($id, $name, $email, $pointsBalance);

        $this->assertEquals($id, $user->getId());
        $this->assertEquals($name, $user->getName());
        $this->assertEquals($email, $user->getEmail());
        $this->assertEquals($pointsBalance, $user->getPointsBalance());
    }

    /**
     * @dataProvider userProvider
     * @param int    $id
     * @param string $username
     * @param string $firstName
     * @param string $lastName
     */
    public function testJsonSerialize(int $id, string $name, string $email, int $pointsBalance)
    {
        $user = new User($id, $name, $email, $pointsBalance);

        $expectedPayload = json_encode([
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'pointsBalance' => $pointsBalance,
        ]);

        $this->assertEquals($expectedPayload, json_encode($user));
    }
}

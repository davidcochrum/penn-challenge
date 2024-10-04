<?php

declare(strict_types=1);

namespace App\Application\Actions\User;

use Psr\Http\Message\ResponseInterface as Response;

class RedeemPointsAction extends UserAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $userId = (int) $this->resolveArg('id');
        $user = $this->userRepository->findUserOfId($userId);

        $params = $this->request->getParsedBody();
        $user->subtractPoints($params['points']);
        $this->userRepository->update($user);

        $this->logger->info("User redeemed points.");

        return $this->respondWithData($user);
    }
}

<?php

namespace App\Controller;

use App\Service\User\Persistent\UserPersistentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api')]
final class UserController extends AbstractController
{
    private const int USER_PAGINATION_LIMIT = 10;

    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly UserPersistentService $userPersistentService,
    ) {}

    #[Route('/users', name: 'app_user')]
    public function index(
        #[MapQueryParameter] int $page = 1,
        #[MapQueryParameter] int $limit = self::USER_PAGINATION_LIMIT,
    ): JsonResponse {
        if ($page < 1) {
            $page = 1;
        }

        if ($limit < 1 || $limit > self::USER_PAGINATION_LIMIT) {
            $limit = self::USER_PAGINATION_LIMIT;
        }

        $dto = $this->userPersistentService->getPaginatedUsers($page, $limit);

        return new JsonResponse($this->serializer->serialize($dto, 'json'), json: true);
    }
}

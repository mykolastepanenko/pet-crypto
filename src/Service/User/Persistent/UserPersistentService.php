<?php

namespace App\Service\User\Persistent;

use App\Component\Paginator\Dto\MetaDto;
use App\Component\Paginator\Dto\PaginationDto;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;

final readonly class UserPersistentService
{
    public function __construct(
        private UserRepository $userRepository,
        private PaginatorInterface $paginator,
    ) {}

    public function getPaginatedUsers(int $page, int $limit): PaginationDto
    {
        $queryBuilder = $this->userRepository
            ->createQueryBuilder('u')
            ->orderBy('u.id', 'ASC');

        $query = $this->paginator->paginate(
            $queryBuilder,
            $page,
            $limit,
        );

        $users = $query->getItems();
        $totalItems = $query->getTotalItemCount();

        return new PaginationDto(
            $users,
            new MetaDto(
                $page,
                $limit,
                $totalItems,
            ),
        );
    }
}

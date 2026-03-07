<?php

namespace App\Service\Persistent;

use App\Component\Paginator\Dto\MetaDto;
use App\Component\Paginator\Dto\PaginationDto;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;

final readonly class UserPersistentService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private PaginatorInterface $paginator,
    ) {}

    public function getPaginatedUsers(int $page, int $limit): PaginationDto
    {
        $queryBuilder = $this->entityManager
            ->getRepository(User::class)
            ->createQueryBuilder('u')
            ->orderBy('u.id', 'ASC');

        $query = $this->paginator->paginate(
            $queryBuilder,
            $page,
            $limit,
        );

        $users = $query->getItems();
        $totalItems = $query->getTotalItemCount();
        $perPage = $query->getItemNumberPerPage();
        $totalPages = (int)ceil($totalItems / $perPage);

        return new PaginationDto(
            $users,
            new MetaDto(
                $page,
                $perPage,
                $totalItems,
                $totalPages,
            ),
        );
    }
}

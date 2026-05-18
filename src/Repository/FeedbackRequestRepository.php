<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\FeedbackRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FeedbackRequest>
 */
class FeedbackRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FeedbackRequest::class);
    }
}
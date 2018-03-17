<?php

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    
    public function findById($id)
    {
        return $this->createQueryBuilder('c')
            ->where('c.id = :id')->setParameter('id', $id)
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByPost($postId)
    {
        return $this->createQueryBuilder('c')
            ->where('c.post = :post_id')->setParameter('post_id', $postId)
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
}

<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Post::class);
    }

    
    public function findById($id)
    {
        return $this->createQueryBuilder('p')
            ->where('p.id = :id')->setParameter('id', $id)
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findAllPosts()
    {
        return $this->createQueryBuilder('p')
            ->where('p.id is not null')
            ->orderBy('p.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
}

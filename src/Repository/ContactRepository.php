<?php

namespace App\Repository;

use App\Entity\Contact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * @extends ServiceEntityRepository<Contact>
 */
class ContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, private PaginatorInterface $paginatorInterface )
    {
        parent::__construct($registry, Contact::class);
    }


    public function remove(Contact $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findPaginatedContacts(int $page): PaginationInterface
    {
        // On crée une fonction ici car la logique ne doit pas se retouver majoritairement dans le controller, il est avant tout fait pour rediriger sur les vues
        $data = $this->createQueryBuilder('c')
        ->select('c.id','c.firstname','c.lastname')
        ->addOrderBy('c.lastname', 'DESC')
        ->getQuery()
        ->getResult();

        $contacts = $this->paginatorInterface->paginate($data,$page,16);

        return $contacts;
    }

    //    /**
    //     * @return Contact[] Returns an array of Contact objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Contact
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

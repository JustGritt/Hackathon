<?php

namespace App\Repository;

use App\Entity\QuestionHasQuiz;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QuestionHasQuiz>
 *
 * @method QuestionHasQuiz|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestionHasQuiz|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestionHasQuiz[]    findAll()
 * @method QuestionHasQuiz[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionHasQuizRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestionHasQuiz::class);
    }

    public function save(QuestionHasQuiz $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(QuestionHasQuiz $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return QuestionHasQuiz[] Returns an array of QuestionHasQuiz objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('q.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?QuestionHasQuiz
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

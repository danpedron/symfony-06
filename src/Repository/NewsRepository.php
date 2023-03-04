<?php

namespace App\Repository;

use App\Entity\News;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<News>
 *
 * @method News|null find($id, $lockMode = null, $lockVersion = null)
 * @method News|null findOneBy(array $criteria, array $orderBy = null)
 * @method News[]    findAll()
 * @method News[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private NewsCategoryRepository $categoryRepository)
    {
        parent::__construct($registry, News::class);
    }

    public function save(News $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(News $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByCategoryTitle(string $title):array
    {
        $category = $this->categoryRepository->findOneBy([
            'title' => $title,
        ]);

        $news = $this->findBy(
            [
            'category' => $category
        ],[
            'createdAt' =>'DESC'
            ]
        );

        return $news;
    }

    public function createQueryBuilderCategoryTitle($value): QueryBuilder
    {
        return $this->createQueryBuilder('n')
            ->join('n.category','c')
            ->andWhere('c.title like :val')
            ->setParameter('val', '%'.$value.'%')
            ->orderBy('n.createdAt', 'DESC')
            ;
    }

    public function findBySearch($value): array
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.title like :val')
            ->setParameter('val', '%'.$value.'%')
            ->orderBy('n.createdAt', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }


    public function createQueryBuilderBySearch($value): QueryBuilder
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.title like :val')
            ->setParameter('val', '%'.$value.'%')
            ->orderBy('n.createdAt', 'DESC')
        ;
    }

    public function findLastNews(int $qtd=5):array
    {
        return $this->createQueryBuilder('n')
            ->orderBy('n.createdAt','DESC')
            ->setMaxResults($qtd)
            ->getQuery()
            ->getResult()
            ;
    }


//    public function findOneBySomeField($value): ?News
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

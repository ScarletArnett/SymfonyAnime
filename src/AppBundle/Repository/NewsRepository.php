<?php

namespace AppBundle\Repository;
use AppBundle\AppBundle;
use Doctrine\ORM\Tools\Pagination\Paginator;
use InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * NewsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NewsRepository extends \Doctrine\ORM\EntityRepository
{
    public function getAllForIndex() {
        return $this->createQueryBuilder("news")->addSelect("anime")->addSelect("studio")
            ->leftJoin("news.anime","anime")
            ->leftJoin("anime.studios","studio")
            ->orderBy("news.dateMaj","ASC")
            ->getQuery()->getResult();
    }

    public function getAllForIndexByAnime($id) {
        return $this->createQueryBuilder("news")->addSelect("anime")->addSelect("studio")
            ->leftJoin("news.anime","anime")
            ->leftJoin("anime.studios","studio")
            ->where("news.anime = (:expected)")
            ->setParameter('expected',$id)
            ->orderBy("news.dateMaj","ASC")
            ->getQuery()->getResult();
    }

    public function getAllForIndexOrderBy($id) {
        return $this->createQueryBuilder("news")->addSelect("anime")->addSelect("studio")
            ->leftJoin("news.anime","anime")
            ->leftJoin("anime.studios","studio")
            ->where("studio.id = (:expected)")
            ->setParameter('expected',$id)
            ->getQuery()->getResult();
    }

    public function listIndex($page = 1, $max = 5)
    {
        $qb = $this->createQueryBuilder('news');
        $qb->setFirstResult(($page-1) * $max)
            ->setMaxResults($max);


        return new Paginator($qb);
    }

    public function listIndexOrdered($page = 1, $max = 5, $id){
        $qb = $this->createQueryBuilder('news')
            ->addSelect("anime")->addSelect("studio")
            ->leftJoin("news.anime","anime")
            ->leftJoin("anime.studios","studio")
            ->where("studio.id = (:expected)")
            ->setParameter('expected',$id);
        $qb->setFirstResult(($page-1) * $max)
            ->setMaxResults($max);

        return new Paginator($qb);
    }
}

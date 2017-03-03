<?php

namespace AppBundle\Repository;

/**
 * AnimeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AnimeRepository extends \Doctrine\ORM\EntityRepository
{
    public function getAll() {
        return $this->createQueryBuilder("a")->addSelect("e")->addSelect("s")
            ->leftJoin("a.editeur", "e")
            ->leftJoin("a.studios", "s")
            ->getQuery()->getResult();
    }

    public function incrementConsult($id){
        return $this->getEntityManager()->createQueryBuilder()
            ->update("AppBundle:Anime","anime")
            ->set("anime.consulted","anime.consulted + 1")
            ->where("anime.id = (:expected)")
            ->setParameter("expected",$id)->getQuery()->execute();
    }

    public function getAnimeByEditor($id) {
        return $this->createQueryBuilder("a")->addSelect("e")
            ->leftJoin("a.editeur","e")
            ->where("a.editeur = (:expected)")
            ->setParameter("expected",$id)->getQuery()->getResult();
    }

    public function publishState($id, $value) {
        $real_value = null;
        if($value == 0) {
            $real_value = 1;
        }
        if($value == 1) {
            $real_value = 0;
        }
        return $this->getEntityManager()->createQueryBuilder()
            ->update("AppBundle:Anime","anime")
            ->set("anime.isRelease", $real_value)
            ->where("anime.id = (:expected)")
            ->setParameter("expected", $id)->getQuery()->execute();
    }
}

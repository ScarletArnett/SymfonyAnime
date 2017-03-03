<?php

namespace AppBundle\Repository;

/**
 * EditeurRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EditeurRepository extends \Doctrine\ORM\EntityRepository
{
    public function getStudioByEditor($id) {
        return $this->createQueryBuilder("editeur")->addSelect("studio")
            ->leftJoin("editeur.studios", "studio")
            ->where("editeur.id = (:expected)")
            ->setParameter("expected",$id)->getQuery()->getResult();
    }

    public function getAnimeByEditor($id) {
        return $this->createQueryBuilder("editeur")->addSelect("anime")
            ->leftJoin("editeur.animes", "anime")
            ->where("editeur.id = (:expected)")
            ->setParameter("expected",$id)->getQuery()->getResult();
    }
}

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Editeur
 *
 * @ORM\Table(name="editeur")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EditeurRepository")
 */
class Editeur {

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Anime", mappedBy="editeur")
     */
    private $animes;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Studio", mappedBy="editeur")
     */
    private $studios;


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Editeur
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->animes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->studios = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add anime
     *
     * @param \AppBundle\Entity\Anime $anime
     *
     * @return Editeur
     */
    public function addAnime(\AppBundle\Entity\Anime $anime)
    {
        $this->animes[] = $anime;

        return $this;
    }

    /**
     * Remove anime
     *
     * @param \AppBundle\Entity\Anime $anime
     */
    public function removeAnime(\AppBundle\Entity\Anime $anime)
    {
        $this->animes->removeElement($anime);
    }

    /**
     * Get animes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnimes()
    {
        return $this->animes;
    }

    /**
     * Add studio
     *
     * @param \AppBundle\Entity\Studio $studio
     *
     * @return Editeur
     */
    public function addStudio(\AppBundle\Entity\Studio $studio)
    {
        $this->studios[] = $studio;

        return $this;
    }

    /**
     * Remove studio
     *
     * @param \AppBundle\Entity\Studio $studio
     */
    public function removeStudio(\AppBundle\Entity\Studio $studio)
    {
        $this->studios->removeElement($studio);
    }

    /**
     * Get studios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStudios()
    {
        return $this->studios;
    }

    public function __toString()
    {
       return $this->getName();
    }
}

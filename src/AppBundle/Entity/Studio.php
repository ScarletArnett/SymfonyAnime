<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Studio
 *
 * @ORM\Table(name="studio")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StudioRepository")
 */
class Studio {

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Editeur",
    inversedBy="studios")
     * @ORM\JoinColumn(name="editeur_id", referencedColumnName="id")
     */
    private $editeur;


    /**
     * @ORM\ManyToMany (targetEntity="AppBundle\Entity\Anime",
     mappedBy="studios")
     */
    private $animes;


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
     * @var \DateTime
     *
     * @ORM\Column(name="released_date", type="date")
     */
    private $releasedDate;


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
     * @return Studio
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
     * Set releasedDate
     *
     * @param \DateTime $releasedDate
     *
     * @return Studio
     */
    public function setReleasedDate($releasedDate)
    {
        $this->releasedDate = $releasedDate;

        return $this;
    }

    /**
     * Get releasedDate
     *
     * @return \DateTime
     */
    public function getReleasedDate()
    {
        return $this->releasedDate;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->animes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set editeur
     *
     * @param \AppBundle\Entity\Editeur $editeur
     *
     * @return Studio
     */
    public function setEditeur(\AppBundle\Entity\Editeur $editeur = null)
    {
        $this->editeur = $editeur;

        return $this;
    }

    /**
     * Get editeur
     *
     * @return \AppBundle\Entity\Editeur
     */
    public function getEditeur()
    {
        return $this->editeur;
    }

    /**
     * Add anime
     *
     * @param \AppBundle\Entity\Anime $anime
     *
     * @return Studio
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

    public function __toString()
    {
        return $this->getName();
    }
}


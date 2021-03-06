<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Anime
 *
 * @ORM\Table(name="anime")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AnimeRepository")
 */
class Anime {

    /**
     * @ORM\JoinColumn(onDelete="CASCADE")
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\News", mappedBy="anime")
     */
    private $news;

    /**
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Editeur",
    inversedBy="animes")
    * @ORM\JoinColumn(name="editeur_id", referencedColumnName="id")
    */
    private $editeur;


    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Studio", inversedBy="animes")
     * @ORM\JoinTable(name="anime_studio",
     * joinColumns={@ORM\JoinColumn(name="anime_id", referencedColumnName="id")},
     * inverseJoinColumns={@ORM\JoinColumn(name="studio_id", referencedColumnName="id")}
     * )
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
     * @var string
     *
     * @ORM\Column(name="genre", type="string", length=255)
     */
    private $genre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="release_date", type="datetime")
     */
    private $releaseDate;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_release", type="boolean")
     */
    private $isRelease;

    /**
     * @var int
     *
     * @ORM\Column(name="consulted", type="integer")
     */
    private $consulted;


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
     * @return Anime
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
     * Set description
     *
     * @param string $description
     *
     * @return Anime
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set releaseDate
     *
     * @param \DateTime $releaseDate
     *
     * @return Anime
     */
    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * Get releaseDate
     *
     * @return \DateTime
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * Set isRelease
     *
     * @param boolean $isRelease
     *
     * @return Anime
     */
    public function setIsRelease($isRelease)
    {
        $this->isRelease = $isRelease;

        return $this;
    }

    /**
     * Get isRelease
     *
     * @return bool
     */
    public function getIsRelease()
    {
        return $this->isRelease;
    }

    /**
     * Set consulted
     *
     * @param integer $consulted
     *
     * @return Anime
     */
    public function setConsulted($consulted)
    {
        $this->consulted = $consulted;

        return $this;
    }


    /**
     * Get consulted
     *
     * @return int
     */
    public function getConsulted()
    {
        return $this->consulted;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->studios = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set editeur
     *
     * @param \AppBundle\Entity\Editeur $editeur
     *
     * @return Anime
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
     * Add studio
     *
     * @param \AppBundle\Entity\Studio $studio
     *
     * @return Anime
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

    /**
     * Set genre
     *
     * @param string $genre
     *
     * @return Anime
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Add news
     *
     * @param \AppBundle\Entity\News $news
     *
     * @return Anime
     */
    public function addNews(\AppBundle\Entity\News $news)
    {
        $this->news[] = $news;

        return $this;
    }

    /**
     * Remove news
     *
     * @param \AppBundle\Entity\News $news
     */
    public function removeNews(\AppBundle\Entity\News $news)
    {
        $this->news->removeElement($news);
    }

    /**
     * Get news
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNews()
    {
        return $this->news;
    }
}

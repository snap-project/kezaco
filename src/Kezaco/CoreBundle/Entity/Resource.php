<?php

namespace Kezaco\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use FOS\ElasticaBundle\Annotation\Search;
use JMS\Serializer\Annotation as JMS;

/**
 * Resource
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="_type", type="string")
 * @ORM\DiscriminatorMap({"document" = "DocumentResource"})
 * @Search(repositoryClass="Kezaco\CoreBundle\SearchRepository\ResourceRepository")
 * @JMS\ExclusionPolicy("all")
 */
class Resource
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @JMS\Expose
     * @JMS\Groups({"elastica"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     * @Gedmo\Slug(fields={"title", "id"})
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @JMS\Expose
     * @JMS\Groups({"elastica"})
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetime")
     * @Gedmo\Timestampable(on="create")
     * @JMS\Expose
     * @JMS\Groups({"elastica"})
     */
    private $creationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_update", type="datetime")
     * @Gedmo\Timestampable(on="update")
     * @JMS\Expose
     * @JMS\Groups({"elastica"})
     */
    private $lastUpdate;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Kezaco\CoreBundle\Entity\User", inversedBy="apps")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     **/
    private $author;


    /**
     * @ORM\ManyToMany(targetEntity="Kezaco\CoreBundle\Entity\Cycle")
     * @ORM\JoinTable(name="Cycles_Resources")
     */
    private $cycles;

    /**
     * @ORM\ManyToMany(targetEntity="Kezaco\CoreBundle\Entity\ClassYear")
     * @ORM\JoinTable(name="ClassYears_Resources")
     */
    private $classYears;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cycles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->classYears = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Resource
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Resource
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Resource
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
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return Resource
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set lastUpdate
     *
     * @param \DateTime $lastUpdate
     * @return Resource
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    /**
     * Get lastUpdate
     *
     * @return \DateTime
     */
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    /**
     * Set author
     *
     * @param \Kezaco\CoreBundle\Entity\User $author
     * @return Resource
     */
    public function setAuthor(\Kezaco\CoreBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Kezaco\CoreBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Add cycles
     *
     * @param \Kezaco\CoreBundle\Entity\Cycle $cycles
     * @return Resource
     */
    public function addCycle(\Kezaco\CoreBundle\Entity\Cycle $cycles)
    {
        $this->cycles[] = $cycles;

        return $this;
    }

    /**
     * Remove cycles
     *
     * @param \Kezaco\CoreBundle\Entity\Cycle $cycles
     */
    public function removeCycle(\Kezaco\CoreBundle\Entity\Cycle $cycles)
    {
        $this->cycles->removeElement($cycles);
    }

    /**
     * Get cycles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCycles()
    {
        return $this->cycles;
    }

    /**
     * Add classYears
     *
     * @param \Kezaco\CoreBundle\Entity\ClassYear $classYears
     * @return Resource
     */
    public function addClassYear(\Kezaco\CoreBundle\Entity\ClassYear $classYears)
    {
        $this->classYears[] = $classYears;

        return $this;
    }

    /**
     * Remove classYears
     *
     * @param \Kezaco\CoreBundle\Entity\ClassYear $classYears
     */
    public function removeClassYear(\Kezaco\CoreBundle\Entity\ClassYear $classYears)
    {
        $this->classYears->removeElement($classYears);
    }

    /**
     * Get classYears
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClassYears()
    {
        return $this->classYears;
    }
}

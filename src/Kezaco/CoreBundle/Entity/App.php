<?php

namespace Kezaco\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;

/**
 * App
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Serializer\ExclusionPolicy("all")
 */
class App
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Expose
     */
    private $id;

    /**
     * @var array
     *
     * @ORM\Column(name="manifest", type="json_array")
     * @Serializer\Expose
     */
    private $manifest;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Serializer\Expose
     */
    private $name;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Kezaco\CoreBundle\Entity\User", inversedBy="apps")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     **/
    private $author;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppPublicShare", mappedBy="app", orphanRemoval=true)
     **/
    private $publicShares;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetime")
     * @Gedmo\Timestampable(on="create")
     * @Serializer\Expose
     */
    private $creationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_update", type="datetime")
     * @Gedmo\Timestampable(on="update")
     * @Serializer\Expose
     */
    private $lastUpdate;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->shareTokens = new ArrayCollection();
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
     * Set manifest
     *
     * @param array $manifest
     * @return App
     */
    public function setManifest($manifest)
    {
        $this->manifest = $manifest;

        return $this;
    }

    /**
     * Get manifest
     *
     * @return array
     */
    public function getManifest()
    {
        return $this->manifest;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return App
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
     * Set author
     *
     * @param \Kezaco\CoreBundle\Entity\User $author
     * @return \Kezaco\CoreBundle\Entity\User
     */
    public function setAuthor(\Kezaco\CoreBundle\Entity\User $author)
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
     * Add publicShare
     *
     * @param AppPublicShare $publicShare
     * @return App
     */
    public function addPublicShare(AppPublicShare $publicShare)
    {
        $publicShare->setApp($this);
        $this->publicShares[] = $publicShare;

        return $this;
    }

    /**
     * Remove publicShare
     *
     * @param AppPublicShare $publicShare
     */
    public function removePublicShare(AppPublicShare $publicShare)
    {
        $this->publicShares->removeElement($publicShare);
    }

    /**
     * Get publicShares
     *
     * @return ArrayCollection
     */
    public function getPublicShares()
    {
        return $this->publicShares;
    }
}

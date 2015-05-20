<?php

namespace Kezaco\EditorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kezaco\CoreBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Kezaco\EditorBundle\Entity\AppShareToken;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * App
 *
 * @ORM\Table("apps")
 * @ORM\Entity
 */
class App
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
     * @var array
     *
     * @ORM\Column(name="manifest", type="json_array")
     */
    private $manifest;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
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
     * @ORM\OneToMany(targetEntity="Kezaco\EditorBundle\Entity\AppShareToken", mappedBy="app")
     **/
    private $shareTokens;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationDate", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $creationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastUpdate", type="datetime")
     * @Gedmo\Timestampable(on="update")
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
     * @param User $author
     * @return App
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Add shareTokens
     *
     * @param AppShareToken $shareTokens
     * @return App
     */
    public function addShareToken(AppShareToken $shareTokens)
    {
        $this->shareTokens[] = $shareTokens;

        return $this;
    }

    /**
     * Remove shareTokens
     *
     * @param AppShareToken $shareTokens
     */
    public function removeShareToken(AppShareToken $shareTokens)
    {
        $this->shareTokens->removeElement($shareTokens);
    }

    /**
     * Get shareTokens
     *
     * @return ArrayCollection
     */
    public function getShareTokens()
    {
        return $this->shareTokens;
    }
}

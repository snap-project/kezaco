<?php

namespace Kezaco\EditorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Kezaco\EditorBundle\Entity\App;

/**
 * AppShareToken
 *
 * @ORM\Table("app_share_tokens")
 * @ORM\Entity
 */
class AppShareToken
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
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=64)
     */
    private $token;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToOne(targetEntity="App", inversedBy="shareTokens")
     * @ORM\JoinColumn(name="app_id", referencedColumnName="id")
     **/
    private $app;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->apps = new ArrayCollection();
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
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return AppShareToken
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return AppShareToken
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return AppShareToken
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
     * @return AppShareToken
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
     * Set app
     *
     * @param App $apps
     * @return AppShareToken
     */
    public function setApp(App $app = null)
    {
        $this->app = $app;

        return $this;
    }

    /**
     * Get app
     *
     * @return App
     */
    public function getApp()
    {
        return $this->app;
    }
}

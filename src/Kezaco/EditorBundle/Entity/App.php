<?php

namespace Kezaco\EditorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kezaco\CoreBundle\Entity\User;

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
}

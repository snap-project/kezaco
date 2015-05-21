<?php

namespace Kezaco\CoreBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 *
 * @ORM\Table("users")
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Entity
     *
     * @ORM\ManyToMany(targetEntity="Kezaco\MediathequeBundle\Entity\Media", inversedBy="users")
     * @ORM\JoinTable(name="user_media")
     */
    protected $medias;

    /**
     * Constructor
     */
    public function __construct()
    {
      parent::__construct();
      $this->medias = new ArrayCollection();
    }

    /**
     * Add medias
     *
     * @param \Kezaco\MediathequeBundle\Entity\Media $medias
     * @return User
     */
    public function addMedia(\Kezaco\MediathequeBundle\Entity\Media $medias)
    {
        //$medias->addUser($this);
        $this->medias[] = $medias;

        return $this;
    }

    /**
     * Remove medias
     *
     * @param \Kezaco\MediathequeBundle\Entity\Media $medias
     */
    public function removeMedia(\Kezaco\MediathequeBundle\Entity\Media $medias)
    {
        $this->medias->removeElement($medias);
    }

    /**
     * Get medias
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMedias()
    {
        return $this->medias;
    }
}

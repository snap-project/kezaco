<?php

namespace Kezaco\MediathequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Media
 *
 * @ORM\Table("medias")
 * @ORM\Entity(repositoryClass="Kezaco\MediathequeBundle\Entity\MediaRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Media
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
     * @var integer
     *
     * @ORM\Column(name="authorId", type="integer")
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="contentType", type="string", length=50)
     */
    private $contentType;

    /**
     * @var integer
     *
     * @ORM\Column(name="size", type="integer")
     */
    private $size;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var Entity
     *
     * @ORM\ManyToMany(targetEntity="Kezaco\CoreBundle\Entity\User", mappedBy="medias")
     */
    protected $users;

    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    private $temp;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function __construct() {
        $this->users = new ArrayCollection();
        $this->setCreatedAt(new \DateTime());
    }

    /**
     * Set author
     *
     * @param User $author
     * @return Media
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return integer
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Media
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Media
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
     * Set contentType
     *
     * @param string $contentType
     * @return Media
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;

        return $this;
    }

    /**
     * Get contentType
     *
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * Set size
     *
     * @param integer $size
     * @return Media
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return integer
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Media
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Add user
     *
     * @param \Kezaco\CoreBundle\Entity\User $user
     * @return Media
     */
    public function addUser(\Kezaco\CoreBundle\Entity\User $user)
    {
        //$user->addMedia($this);
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Kezaco\CoreBundle\Entity\User $user
     */
    public function removeUser(\Kezaco\CoreBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    public function getAbsolutePath()
    {
      return null === $this->path
        ? null
        : $this->getUploadDir() . '/' . $this->path;
    }

    public function getUploadRootDir()
    {
      return __DIR__.'/../../../../app/'.$this->getUploadDir();
    }

    public function getUploadDir()
    {
      return 'uploads/medias/'.date('Y').'/'.date('m').'/'.date('d');
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->path = $filename.'.'.$this->getFile()->guessExtension();
            $this->contentType = $this->getFile()->getMimeType();
            $this->size = $this->getFile()->getSize();
        }
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
      if (null === $this->getFile()) {
          return;
      }

      // if there is an error when moving the file, an exception will
      // be automatically thrown by move(). This will properly prevent
      // the entity from being persisted to the database on error
      $this->getFile()->move($this->getUploadRootDir(), $this->path);

      // check if we have an old image
      if (isset($this->temp)) {
          // delete the old image
          unlink($this->getUploadRootDir().'/'.$this->temp);
          // clear the temp image path
          $this->temp = null;
      }
      $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
      $file = $this->getAbsolutePath();
      if ($file) {
          unlink($file);
      }
    }

    public function getTotalSize()
    {
      $totalSize = 0;
      foreach ($this->entries  as $entry) {
        $totalSize += $entry->getSize();
      }
      return $totalSize;
    }
}

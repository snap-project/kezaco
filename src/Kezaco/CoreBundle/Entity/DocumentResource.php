<?php

namespace Kezaco\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kezaco\CoreBundle\Entity\Resource;

/**
 * Resource
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class DocumentResource extends Resource
{

    /**
     * @ORM\ManyToMany(targetEntity="Kezaco\CoreBundle\Entity\Document", cascade="all", orphanRemoval=true)
     * @ORM\JoinTable(name="Documents_DocumentResources")
     */
    private $documents;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->documents = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add documents
     *
     * @param \Kezaco\CoreBundle\Entity\Document $documents
     * @return DocumentResource
     */
    public function addDocument(\Kezaco\CoreBundle\Entity\Document $documents)
    {
        $this->documents[] = $documents;

        return $this;
    }

    /**
     * Remove documents
     *
     * @param \Kezaco\CoreBundle\Entity\Document $documents
     */
    public function removeDocument(\Kezaco\CoreBundle\Entity\Document $documents)
    {
        $this->documents->removeElement($documents);
    }

    /**
     * Get documents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDocuments()
    {
        return $this->documents;
    }
}

<?php

namespace Kezaco\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kezaco\CoreBundle\Entity\Resource;
use JMS\Serializer\Annotation as JMS;

/**
 * RemoteResource
 *
 * @ORM\Table()
 * @ORM\Entity
 * @JMS\ExclusionPolicy("all")
 */
class RemoteResource extends Resource
{

    /**
     * @var string
     *
     * @ORM\Column(name="source", type="string", length=64)
     */
    private $source;

    /**
     * @var string
     *
     * @ORM\Column(name="remoteId", type="string", length=64)
     */
    private $remoteId;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="text")
     */
    private $url;


    /**
     * Set url
     *
     * @param string $url
     * @return RemoteResource
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set source
     *
     * @param string $source
     * @return RemoteResource
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set remoteId
     *
     * @param string $remoteId
     * @return RemoteResource
     */
    public function setRemoteId($remoteId)
    {
        $this->remoteId = $remoteId;

        return $this;
    }

    /**
     * Get remoteId
     *
     * @return string 
     */
    public function getRemoteId()
    {
        return $this->remoteId;
    }
}

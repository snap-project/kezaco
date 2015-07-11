<?php

namespace Kezaco\CoreBundle\Twig;

class KezacoCoreExtension extends \Twig_Extension
{
    private $secure_request = false;

    public function getTests()
    {
        return array(
            'instanceof' => new \Twig_Function_Method($this, 'isInstanceOf')
        );
    }

    /**
     * @param $className
     * @param $instance
     * @return bool
     */
    public function isInstanceOf($instance, $className) {
        return is_a($instance, $className);
    }

    public function getName()
    {
        return 'kezaco_core_extension';
    }
}

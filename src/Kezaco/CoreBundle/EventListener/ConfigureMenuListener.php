<?php

namespace Kezaco\CoreBundle\EventListener;

use Kezaco\CoreBundle\Event\ConfigureMenuEvent;
use Symfony\Component\Security\Core\SecurityContextInterface;

class ConfigureMenuListener
{

    private $securityContext;

    public function __construct(SecurityContextInterface $securityContext) {
        $this->securityContext = $securityContext;
    }

    /**
     * @param \Kezaco\CoreBundle\Event\ConfigureMenuEvent $event
     */
    public function onConfigureNavbarRightMenu(ConfigureMenuEvent $event)
    {
        $securityContext = $this->securityContext;
        $menu = $event->getMenu();

        // If user is connected, add logout link
        if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            $menu->addChild('Logout', array('route' => 'fos_user_security_logout'));
        } else {
            // If user is not connected, add login & register links
            $menu->addChild('Login', array('route' => 'fos_user_security_login'));
            $menu->addChild('Register', array('route' => 'fos_user_registration_register'));
        }

    }
}

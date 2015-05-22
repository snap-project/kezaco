<?php

namespace Kezaco\CoreBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\DependencyInjection\ContainerAware;
use Kezaco\CoreBundle\Event\ConfigureMenuEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class Builder extends ContainerAware {

    private $factory;
    private $eventDispatcher;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory, EventDispatcherInterface $eventDispatcher)
    {
        $this->factory = $factory;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function createNavbarRightMenu(RequestStack $requestStack)
    {
        $menu = $this->factory->createItem('root');

        $this->eventDispatcher->dispatch(
            ConfigureMenuEvent::CONFIGURE_NAVBAR_RIGHT_MENU,
            new ConfigureMenuEvent($this->factory, $menu)
        );

        return $menu;
    }

    public function createHomeLeftMenu(RequestStack $requestStack)
    {
        $menu = $this->factory->createItem('root');

        $this->eventDispatcher->dispatch(
            ConfigureMenuEvent::CONFIGURE_HOME_LEFT_MENU,
            new ConfigureMenuEvent($this->factory, $menu)
        );

        return $menu;
    }


}

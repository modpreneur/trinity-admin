<?php
declare(strict_types=1);

namespace Trinity\HtDoc\AdminBundle\EventListener;

use Knp\Menu\ItemInterface;
use Symfony\Component\Routing\Router;
use Symfony\Component\Translation\DataCollectorTranslator;
use Trinity\AdminBundle\Event\MenuEvent;

/**
 * Class MenuListener
 */
class MenuListener
{

    /** @var  Router */
    private $router;

    /**
     * @var DataCollectorTranslator
     */
    private $translator;


    /**
     * MenuListener constructor.
     *
     * @param Router $router
     * @param DataCollectorTranslator $translator
     */
    public function __construct(Router $router, $translator)
    {
        $this->router     = $router;
        $this->translator = $translator;
    }


    /**
     * @param MenuEvent $event
     *
     * @throws \InvalidArgumentException
     * @throws \Trinity\AdminBundle\Exception\MenuException
     * @throws \Symfony\Component\Routing\Exception\InvalidParameterException
     * @throws \Symfony\Component\Routing\Exception\MissingMandatoryParametersException
     * @throws \Symfony\Component\Routing\Exception\RouteNotFoundException
     * @throws \Symfony\Component\Translation\Exception\InvalidArgumentException
     */
    public function onMenuConfigure(MenuEvent $event): void
    {
        $menu = $event->getMenu('sidebar');

        $menu
            ->addChild('Dashboard')
            ->setAttribute('class', 'js-direct-item')
            ->setAttribute('icon', 'trinity trinity-dashboard')
            ->setExtra('orderNumber', 0);

        $menu
            ->addChild('Products')
            ->setAttribute('class', 'js-direct-item')
            ->setAttribute('icon', 'trinity trinity-dashboard')
            ->setExtra('orderNumber', 1);

        $menu
            ->addChild('Users')
            ->setAttribute('class', 'js-direct-item')
            ->setAttribute('icon', 'trinity trinity-dashboard')
            ->setExtra('orderNumber', 2);
    }
}

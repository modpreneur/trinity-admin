<?php

namespace Trinity\AdminBundle\Menu;

use Doctrine\ORM\EntityManager;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Knp\Menu\MenuItem;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Trinity\AdminBundle\Event\AdminEvents;
use Trinity\AdminBundle\Event\MenuEvent;
use WhiteOctober\BreadcrumbsBundle\Model\Breadcrumbs;


class MenuBuilder extends ContainerAware
{
    /** @var FactoryInterface */
    private $factory;

    /** @var EntityManager */
    private $em;

    /** @var Breadcrumbs */
    private $breadcrumbsService;

    /** @var EventDispatcher */
    private $eventDispatcher;

    /** @var ItemInterface[] */
    private $navs = [];

    /** @var MenuEvent */
    private $menuEvent;

    /** @var ContainerInterface */
    protected $container;


    /**
     * @param EventDispatcher $eventDispatcher
     * @param FactoryInterface $factory
     * @param EntityManager $entityManager
     * @param \WhiteOctober\BreadcrumbsBundle\Model\Breadcrumbs $breadcrumbs
     * @param ContainerInterface $container
     */
    public function __construct(
        $eventDispatcher,
        FactoryInterface $factory,
        EntityManager $entityManager,
        Breadcrumbs $breadcrumbs,
        ContainerInterface $container
    ) {
        $this->factory = $factory;
        $this->em = $entityManager;
        $this->breadcrumbsService = $breadcrumbs;
        $this->eventDispatcher = $eventDispatcher;
        $this->container = $container;

        $sidebar_menu = $this->factory->createItem(
            'root',
            array(
                'childrenAttributes' => array(
                    'class' => 'sidebar',
                ),
            )
        );
        $this->navs['sidebar'] = $sidebar_menu;

        $quick_menu = $this->factory->createItem(
            'root',
            array(
                'childrenAttributes' => array(
                    'class' => 'show-quick-add',
                ),
            )
        );
        $this->navs['quick-menu'] = $quick_menu;

        $user_menu = $this->factory->createItem(
            'root',
            array(
                'childrenAttributes' => array(
                    'class' => 'show-drop-login',
                ),
            )
        );
        $this->navs['user_menu'] = $user_menu;

        $this->menuEvent = new MenuEvent($this->factory);
        $this->menuEvent->addNav('sidebar', $sidebar_menu)->addNav('quick-menu', $quick_menu)->addNav(
                'user_menu',
                $user_menu
            );
    }


    /**
     * @param RequestStack $requestStack
     *
     * @return ItemInterface
     */
    public function createMainMenu(RequestStack $requestStack)
    {
        $menu = $this->navs['sidebar'];
        $menu->setUri($requestStack->getCurrentRequest()->getRequestUri());

        $this->eventDispatcher->dispatch(
            AdminEvents::MENU_CREATE,
            $this->menuEvent
        );

        $this->orderMenu($menu);

        return $menu;
    }


    /**
     * @param Request $request
     *
     * @return \Knp\Menu\ItemInterface
     */
    public function createBreadcrumbsMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');

        return $menu;
    }


    /**
     * @param ItemInterface $menu
     * @throws \Exception when $orderNumber doesn't meet the requirements
     */
    private function orderMenu(ItemInterface $menu)
    {
        $unorderedNames = [];
        $names = [];
        $userIndexes = [];
        $hiddenItems = [];

        /**
         * @var int $key
         * @var MenuItem $menuItem
         */
        foreach ($menu->getChildren() as $key => $menuItem) {

            $orderNumber = $menuItem->getExtra('orderNumber');

            if ($orderNumber && !is_numeric($orderNumber)) {
                throw new \Exception('Order number must be an integer.');
            }
            if ($orderNumber < 0) {
                throw new \Exception('Order number must be higher or equal to 0.');
            }

            if ($menuItem->getChildren() != null) {
                $this->orderMenu($menuItem);
            }

            if ($orderNumber == null) {
                $unorderedNames[] = $menuItem->getName();

                if (!$this->userHasPermissions($menuItem)) {
                    $hiddenItems[] = $menuItem->getName();
                }
            }
        }

        foreach ($menu->getChildren() as $key => $menuItem) {
            $orderNumber = $menuItem->getExtra('orderNumber');

            if ($orderNumber != null) {
                $orderArray = $this->orderArray($names, $userIndexes, $orderNumber);
                $names = $orderArray[1];
                $userIndexes = $orderArray[2];
                $idx = $orderArray[0];

                $userIndexes[$idx] = $orderNumber;
                $names[$idx] = $menuItem->getName();

                if (!$this->userHasPermissions($menuItem)) {
                    $hiddenItems[] = $menuItem->getName();
                }
            }
        }

        $names = array_merge($unorderedNames, $names);
        ksort($names);

        $menu->reorderChildren($names);

        foreach ($hiddenItems as $hiddenItem) {
            $menu->removeChild($hiddenItem);
        }
    }


    /**
     * @param array $names
     * @param array $userIndexes
     * @param int $currOrderNumber
     * @return array
     */
    private function orderArray(array $names, array $userIndexes, $currOrderNumber)
    {
        for ($i = 0; $i <= $currOrderNumber + count($names); $i++) {
            if (!empty($names[$i])) {
                if ($userIndexes[$i] > $currOrderNumber) {
                    $names = $this->shiftArray($names, $i, 1);

                    $userIndexes = $this->shiftArray($userIndexes, $i, 1);

                    return array($i, $names, $userIndexes);
                }
            } else {
                return array($i, $names, $userIndexes);
            }
        }

        return array(-1, $names, $userIndexes);
    }


    /**
     * @param array $shiftArray
     * @param int $fromElement
     * @param int $shiftSize
     * @returns array
     */
    private function shiftArray(array $shiftArray, $fromElement, $shiftSize)
    {
        for ($i = count($shiftArray) + $shiftSize - 1; $i > $fromElement; $i--) {
            $shiftArray[$i] = $shiftArray[$i - $shiftSize];
        }

        return $shiftArray;
    }


    /**
     * @param MenuItem $menuItem
     * @return int
     */
    private function userHasPermissions(MenuItem $menuItem)
    {
        $roles = $menuItem->getExtra('roles');
        if ($roles != null) {
            foreach ($roles as $role) {
                if ($this->container->get('security.authorization_checker')->isGranted($role)) {
                    return true;
                }
            }
        } else {
            return true;
        }

        return false;
    }
}

<?php

namespace Trinity\AdminBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Knp\Menu\MenuItem;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Trinity\AdminBundle\Event\AdminEvents;
use Trinity\AdminBundle\Event\MenuEvent;

/**
 * Class MenuBuilder
 * @package Trinity\AdminBundle\Menu
 */
class MenuBuilder
{
    /** @var EventDispatcherInterface */
    private $eventDispatcher;

    /** @var FactoryInterface */
    private $factory;

    /** @var AuthorizationCheckerInterface  */
    private $authorizationChecker;

    /** @var ItemInterface[] */
    private $navs = [];

    /** @var MenuEvent */
    private $menuEvent;


    /**
     * @param EventDispatcherInterface $eventDispatcher
     * @param FactoryInterface $factory
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(
        EventDispatcherInterface $eventDispatcher,
        FactoryInterface $factory,
        AuthorizationCheckerInterface $authorizationChecker
    ) {
        $this->eventDispatcher = $eventDispatcher;
        $this->factory = $factory;
        $this->authorizationChecker = $authorizationChecker;

        $sidebar_menu = $this->factory->createItem(
            'root',
            [
                'childrenAttributes' => [
                    'class' => 'sidebar',
                ],
            ]
        );
        $this->navs['sidebar'] = $sidebar_menu;

        $quick_menu = $this->factory->createItem(
            'root',
            [
                'childrenAttributes' => [
                    'class' => 'show-quick-add',
                ],
            ]
        );
        $this->navs['quick-menu'] = $quick_menu;

        $user_menu = $this->factory->createItem(
            'root',
            [
                'childrenAttributes' => [
                    'class' => 'show-drop-login',
                ],
            ]
        );
        $this->navs['user_menu'] = $user_menu;

        $this->menuEvent = new MenuEvent($this->factory);
        $this->menuEvent
            ->addNav('sidebar', $sidebar_menu)
            ->addNav('quick-menu', $quick_menu)
            ->addNav('user_menu', $user_menu)
        ;
    }

    /**
     * @param RequestStack $requestStack
     *
     * @return ItemInterface
     * @throws \InvalidArgumentException
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
     * @param ItemInterface $menu
     * @throws \InvalidArgumentException when $orderNumber doesn't meet the requirements
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
                throw new \InvalidArgumentException('Order number must be an integer.');
            }

            if ($orderNumber < 0) {
                throw new \InvalidArgumentException('Order number must be higher or equal to 0.');
            }

            if ($menuItem->getChildren() !== null) {
                $this->orderMenu($menuItem);
            }

            if ($orderNumber === 0) {
                $unorderedNames[] = $menuItem->getName();

                if (!$this->userHasPermissions($menuItem)) {
                    $hiddenItems[] = $menuItem->getName();
                }
            }
        }

        foreach ($menu->getChildren() as $key => $menuItem) {
            $orderNumber = $menuItem->getExtra('orderNumber');

            if ($orderNumber !== 0) {
                $orderArray = $this->orderArray($names, $userIndexes, $orderNumber);
//                $names = $orderArray[1];
//                $userIndexes = $orderArray[2];
//                $idx = $orderArray[0];
                list($idx, $names, $userIndexes) = $orderArray;

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

                    return [$i, $names, $userIndexes];
                }
            } else {
                return [$i, $names, $userIndexes];
            }
        }

        return [-1, $names, $userIndexes];
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
        if ($roles !== null) {
            foreach ($roles as $role) {
                if ($this->authorizationChecker->isGranted($role)) {
                    return true;
                }
            }
        } else {
            return true;
        }

        return false;
    }
}

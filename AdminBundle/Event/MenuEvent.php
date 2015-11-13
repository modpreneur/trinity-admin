<?php

namespace Trinity\AdminBundle\Event;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\EventDispatcher\Event;
use Trinity\AdminBundle\Exception\MenuException;


class MenuEvent extends Event
{
    private $factory;
    private $navs = [];

        /**
         * @param \Knp\Menu\FactoryInterface $factory
         */
        public function __construct(FactoryInterface $factory)
        {
            $this->factory = $factory;
        }

        /**W
         * @return \Knp\Menu\FactoryInterface
         */
        public function getFactory()
        {
            return $this->factory;
        }

        /**
         * @param array $navs
         */
        public function setNavs($navs)
        {
            $this->navs = $navs;
        }

        /**
         * @param ItemInterface $interface
         * @param $name
         *
         * @return $this
         */
        public function addNav($name, ItemInterface $interface)
        {
            $this->navs[$name] = $interface;

            return $this;
        }

        /**
         * @param $name
         *
         * @return ItemInterface
         *
         * @throws MenuException
         */
        public function getMenu($name)
        {
            if (isset($this->navs[$name])) {
                return $this->navs[$name];
            }
            throw new MenuException("Menu with name: $name doesn't exists.");
        }
}

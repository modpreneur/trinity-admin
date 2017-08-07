<?php
/**
 * Trinity project
 *
 * @author Tomáš Jančar
 */
namespace Trinity\AdminBundle\Event;

/**
 * Class AdminEvents
 * @package Trinity\AdminBundle\Event
 *
 */
class AdminEvents
{
    /**
     * @Event("Trinity\AdminBundle\Event\MenuEvent")
     */
    const MENU_CREATE       = 'trinity.main_menu.configure';

    //const QUICK_MENU_CREATE = 'trinity.quick_menu.configure';
    //const USER_MENU_CREATE  = 'trinity.user_menu.configure';
}

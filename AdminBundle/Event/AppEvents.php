<?php

namespace Trinity\AdminBundle\Event;

class AppEvents
{
    // navigation
    const MENU_CREATE = 'trinity.main_menu.configure';
    const QUICK_MENU_CREATE = 'trinity.quick_menu.configure';
    const USER_MENU_CREATE = 'trinity.user_menu.configure';

    // widgets
    const WIDGET_INIT = 'trinity.widget_init';
    const WIDGET_TYPE_INIT = 'trinity.widget_type_init';
}

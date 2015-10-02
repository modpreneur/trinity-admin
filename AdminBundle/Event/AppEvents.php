<?php

namespace Trinity\AdminBundle\Event;

class AppEvents
{
    // navigation
    const MENU_CREATE = 'app.main_menu.configure';
    const QUICK_MENU_CREATE = 'app.quick_menu.configure';
    const USER_MENU_CREATE = 'app.user_menu.configure';

    // widgets
    const WIDGET_INIT = 'app.widget_init';
    const WIDGET_TYPE_INIT = 'app.widget_type_init';
}

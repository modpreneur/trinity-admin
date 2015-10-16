<?php

namespace Trinity\AdminBundle\Event;

use Trinity\AdminBundle\Widget\WidgetManager;
use Symfony\Component\EventDispatcher\Event;

class WidgetEvent extends Event
{
    /** @var  WidgetManager */
    protected $widgetManager;

    public function __construct($widgetManager)
    {
        $this->widgetManager = $widgetManager;
    }

    /**
     * @return WidgetManager
     */
    public function getWidgetManager()
    {
        return $this->widgetManager;
    }
}

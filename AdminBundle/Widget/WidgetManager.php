<?php

namespace Trinity\AdminBundle\Widget;

use Dmishh\Bundle\SettingsBundle\Manager\SettingsManager;
use Trinity\AdminBundle\Event\AppEvents;
use Trinity\AdminBundle\Event\WidgetEvent;
use Symfony\Component\EventDispatcher\Debug\TraceableEventDispatcher;

class WidgetManager
{
    private $widgets = [];

    private $widgetTypes = [];

    private $init = false;

    /** @var  TraceableEventDispatcher */
    private $eventDispatcher;

    /** @var  SettingsManager */
    private $settingsManager;

    private $GLOBAL_WIDGETS = [0 => 'app-list', 1 => 'last-product-list'];

    /**
     * @param $eventDispatcher
     * @param $settingsManager
     */
    public function __construct($eventDispatcher, $settingsManager)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->settingsManager = $settingsManager;
    }

    /**
     * @param string $id
     * @param string $name
     *
     * @return WidgetType
     *
     * @throws WidgetException
     */
    public function registerWidgetType($id, $name)
    {
        if ($this->hasType($id)) {
            throw new WidgetException("Widget type $id already exists.");
        }

        $id = str_replace(' ', '', $id);
        $wt = new WidgetType($id, $name);
        $this->widgetTypes[$id] = $wt;

        return $wt;
    }

    /**
     * @param string $typeID
     *
     * @return bool
     */
    public function hasType($typeID)
    {
        return array_key_exists($typeID, $this->widgetTypes);
    }

    /**
     * @return array
     */
    public function getWidgetTypes()
    {
        return $this->widgetTypes;
    }

    /**
     * @param WidgetType[] $widgetTypes
     */
    public function setWidgetTypes($widgetTypes)
    {
        $this->widgetTypes = $widgetTypes;
    }

    /**
     * @param null $type
     *
     * @return WidgetItem[]
     */
    public function getWidgets($type = null)
    {
        $this->init();

        $widgets = $this->widgets;
        if ($type) {
            $widgets = array_filter($this->widgets, function (WidgetItem $el) use ($type) {
                if ($el->getType()->getId() == $type) {
                    return $el;
                }
            });
        }

        return $widgets;
    }

    /**
     * @param mixed $widgets
     */
    public function setWidgets($widgets)
    {
        $this->widgets = $widgets;
    }

    private function init()
    {
        if (!$this->init) {
            $this->eventDispatcher->dispatch(AppEvents::WIDGET_TYPE_INIT, new WidgetEvent($this));
            $this->eventDispatcher->dispatch(AppEvents::WIDGET_INIT, new WidgetEvent($this));
        }

        $this->init = true;
    }

    /**
     * @param $id
     * @param $type
     * @param $name
     * @param $renderLink
     * @param array $attrs
     *
     * @throws WidgetException
     */
    public function createAndAddWidget($id, $type, $name, $renderLink, $attrs = array())
    {
        $this->addWidget($this->createWidget($id, $type, $name, $renderLink, $attrs));
    }

    /**
     * @param WidgetItem $widgetItem
     *
     * @return $this
     *
     * @throws WidgetException
     */
    public function addWidget(WidgetItem $widgetItem)
    {
        if (!$this->hasType($widgetItem->getType()->getId())) {
            throw new WidgetException('Widget type '.$widgetItem->getType()->getId()." doesn't exists. Please register this type first.");
        }

        if (empty($this->widgets[$widgetItem->getId()])) {
            $this->widgets[$widgetItem->getId()] = $widgetItem;
        } else {
            throw new WidgetException('Widget ID '.$widgetItem->getId().' is already exists. Change widget ID.');
        }

        return $this;
    }

    /**
     * @param $id
     * @param $type
     * @param $name
     * @param $renderLink
     * @param array $attrs
     *
     * @return WidgetItem
     */
    public function createWidget($id, $type, $name, $renderLink, $attrs = array())
    {
        $wt = $this->widgetTypes[$type];

        return new WidgetItem($id, $wt, $name, $renderLink, $attrs);
    }

    /**
     * @param $widgetID
     *
     * @return WidgetItem
     *
     * @throws WidgetException
     */
    public function getByID($widgetID)
    {
        $items = array_filter($this->widgets, function (WidgetItem $item) use ($widgetID) {
            if ($item->getId() == $widgetID) {
                return $item;
            }
        });

        if (empty($items)) {
            throw new WidgetException("Widget with $widgetID doesn't exists.");
        }

        return reset($items);
    }

    /**
     * @param string $categoryName
     *
     * @return array
     */
    public function getTypesByCategory($categoryName)
    {
        $this->init();

        $types = $this->widgetTypes;
        $types = array_filter($types, function (WidgetType $widgetType) use ($categoryName) {
            if (in_array($categoryName, $widgetType->getCategories())) {
                return $widgetType;
            }
        });

        usort($types, function (WidgetType $a, WidgetType $b) use ($categoryName) {
            return strcmp($a->getCategoryOrder($categoryName), $b->getCategoryOrder($categoryName));
        });

        return $types;
    }

    /**
     * @param $user
     *
     * @return string[]
     */
    public function getWidgetsIDsForUser($user)
    {
        if ($this->settingsManager->get('widgets_user',
                $user) === null && $this->settingsManager->get('widgets_default') === null
        ) {
            $this->settingsManager->setMany(['widgets_default' => $this->GLOBAL_WIDGETS]);
            $this->settingsManager->setMany(['widgets_user' => $this->GLOBAL_WIDGETS]);
        }

        if ($this->settingsManager->get('widgets_user',
                $user) === null && $this->settingsManager->get('widgets_default')
        ) {
            $this->settingsManager->setMany(['widgets_default' => $this->settingsManager->get('widgets_default')]);
        }

        return $this->settingsManager->get('widgets_user', $user);
    }

    /**
     * @param array $widgetsNew
     * @param $user
     */
    public function addUserWidgets(array $widgetsNew, $user)
    {
        $widgets = $this->settingsManager->get('widgets_user', $user);
        foreach ($widgetsNew as $w) {
            $widgets[] = $w;
        }
        $this->settingsManager->setMany(['widgets_user' => $widgets], $user);
    }

    /**
     * @param array $widgets
     * @param $user
     */
    public function setUserWidgets(array $widgets, $user)
    {
        $this->settingsManager->setMany(['widgets_user' => $widgets], $user);
    }

    public function removeUserWidget($widgetID, $user)
    {
        $r = false;
        $widgets = $this->settingsManager->get('widgets_user', $user);

        if (($key = array_search($widgetID, $widgets)) !== false) {
            unset($widgets[$key]);
            $r = true;
        }

        $this->settingsManager->setMany(['widgets_user' => $widgets]);

        return $r;
    }
}

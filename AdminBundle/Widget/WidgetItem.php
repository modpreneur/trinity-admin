<?php

namespace Trinity\AdminBundle\Widget;

class WidgetItem
{
    /** @var  string */
    private $id;

    /** @var  WidgetType */
    private $type;

    /** @var  string */
    private $name;

    /** @var  int */
    private $order;

    /** @var  string */
    private $renderLink;

    /** @var  array */
    private $attributes;

    /**
     * @param $id
     * @param $type
     * @param $name
     * @param string $renderLink
     * @param array  $attributes
     */
    public function __construct($id, $type, $name, $renderLink = '', $attributes = array())
    {
        $this->id = $id;
        $this->type = $type;
        $this->name = $name;
        $this->renderLink = $renderLink;
        $this->attributes = $attributes;
    }

    /**
     * @return WidgetType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param WidgetType $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param int $order
     *
     * @return $this
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * @return string
     */
    public function getRenderLink()
    {
        return $this->renderLink;
    }

    /**
     * @param string $renderLink
     *
     * @return $this
     */
    public function setRenderLink($renderLink)
    {
        $this->renderLink = $renderLink;

        return $this;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     *
     * @return $this
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * @param $name
     * @param $attr
     *
     * @return $this
     */
    public function addAttributes($name, $attr)
    {
        $this->attributes[$name] = $attr;

        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $attribute
     *
     * @return string|NULL
     */
    public function getAttribute($attribute)
    {
        if (isset($this->attributes[$attribute])) {
            return $this->attributes[$attribute];
        } else {
            return;
        }
    }
}

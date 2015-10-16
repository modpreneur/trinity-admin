<?php

namespace Trinity\AdminBundle\Widget;

class WidgetType
{
    /** @var  string */
    private $id;

    /** @var  string */
    private $name;

    /** @var array  */
    private $categories = [];

    private $categoriesOrder = [];

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param array $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    /**
     * @param $categoryName
     * @param int $order
     *
     * @return $this
     */
    public function addCategory($categoryName, $order = 0)
    {
        $this->categories[] = $categoryName;
        $this->categoriesOrder[$categoryName] = $order;

        return $this;
    }

    /**
     * @param $categoryName
     *
     * @return int
     */
    public function getCategoryOrder($categoryName)
    {
        return $this->categoriesOrder[$categoryName];
    }
}

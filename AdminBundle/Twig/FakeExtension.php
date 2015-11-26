<?php

namespace Trinity\AdminBundle\Twig;


class FakeExtension extends \Twig_Extension
{


    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('getSidebarMsgs', array($this, 'getRedisMsgs')),
            new \Twig_SimpleFilter('json_decode', array($this, 'jsonDecode')),
        );
    }

    public function jsonDecode($json)
    {
        return json_decode($json,true);
    }

    public function getRedisMsgs()
    {
        return [[], [], [], 0];
    }


    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'redis_extension';
    }
}
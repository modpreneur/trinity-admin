<?php

namespace Trinity\AdminBundle\Twig;


class SidebarExtension extends \Twig_Extension
{
    private $router;

    public function __construct($router) {
        $this->router = $router;
    }

    /**
     *
     * In master application (as Necktie,Venice,etc)
     * create new twig extension getSidebarMsgs
     * that returns your messages for sidebar.
     * Already implemented in Necktie/AppBundle
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('getSidebarMsgs', array($this, 'getRedisMsgs')),
            new \Twig_SimpleFilter('json_decode', array($this, 'jsonDecode')),
            new \Twig_SimpleFilter('routeExists', array($this, 'routeExists'))
        );
    }

    public function jsonDecode($json)
    {
        return json_decode($json,true);
    }

    public function getRedisMsgs()
    {
        /**
         * return array with:
         *  array of messages (for format look at extend_layout.html.twig)
         *  array of origin times of each message
         *  array of user who invoked message
         *  int count of new(yet not showed) messages
         *  array of keys for given message (for removing)
         *
         * count of elements for each sub-array has to be same
         * (Or at least fist array has to be bigger)
         */
        return [[], [], [], 0, []];
    }

    function routeExists($name)
    {
        // I assume that you have a link to the container in your twig extension class

        return (null === $this->router->getRouteCollection()->get($name)) ? false : true;
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
<?php

namespace Trinity\AdminBundle\Twig;

use Symfony\Bundle\FrameworkBundle\Routing\Router;

/**
 * Class SidebarExtension
 * @package Trinity\AdminBundle\Twig
 */
class SidebarExtension extends \Twig_Extension
{
    /** @var  Router */
    protected $router;

    /**
     * SidebarExtension constructor.
     *
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     *
     * In master application (as Necktie,Venice,etc)
     * create new twig extension getBarMsgs
     * that returns your messages for sidebar.
     * Already implemented in Necktie/AppBundle
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('getBarMsgs', [$this, 'getRedisMsgs']),
            new \Twig_SimpleFilter('json_decode', [$this, 'jsonDecode']),
            new \Twig_SimpleFilter('routeExists', [$this, 'routeExists'])
        ];
    }

    /**
     * @param $json
     *
     * @return mixed
     */
    public function jsonDecode($json)
    {
        return json_decode($json, true);
    }

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
    public function getRedisMsgs()
    {
        return [[], [], [], 0, []];
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function routeExists($name)
    {
        // I assume that you have a link to the container in your twig extension class

        return null === $this->router->getRouteCollection()->get($name);
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
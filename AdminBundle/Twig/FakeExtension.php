<?php

namespace Trinity\AdminBundle\Twig;


class FakeExtension extends \Twig_Extension
{
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
         *
         * count of elements for each sub-array has to be same
         * (Or at least fist array has to be bigger)
         */
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
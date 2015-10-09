<?php

namespace Trinity\AdminBundle\Twig;


class AdminHelperExtension extends \Twig_Extension
{

    /** @var $appVersion string */
    private $appVersion;


    /**
     * @param mixed $appVersion
     */
    public function setAppVersion($appVersion)
    {
        $this->appVersion = $appVersion;
    }


    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'getVersion' => new \Twig_Function_Method($this, 'getVersion'),
        );
    }


    public function getVersion(){
        return $this->appVersion;
    }




    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'adminHelper';
    }
}
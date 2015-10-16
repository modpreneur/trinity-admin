<?php

namespace Trinity\AdminBundle\Twig;


class AdminHelperExtension extends \Twig_Extension
{

    /** @var $appVersion string */
    private $appVersion;

    /** @var $appClass string */
    private $appClass;


    /**
     * @param mixed $appVersion
     */
    public function setAppVersion($appVersion)
    {
        $this->appVersion = $appVersion;
    }

    /**
     * @param string $appClass
     */
    public function setAppClass($appClass)
    {
        $this->appClass = $appClass;
    }


    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'getVersion' => new \Twig_Function_Method($this, 'getVersion'),
            'getAppClass' => new \Twig_Function_Method($this, 'getAppClass'),
        );
    }


    public function getVersion(){
        return $this->appVersion;
    }


    public function getAppClass(){
        return $this->appClass;
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
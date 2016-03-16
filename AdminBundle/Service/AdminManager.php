<?php


namespace Trinity\AdminBundle\Service;

/**
 * Class AdminManager
 * @package Trinity\AdminBundle\Service
 */
class AdminManager
{

    /** @var  string */
    private $searchText;

    /** @var  string */
    private $appVersion;


    /**
     * AdminManager constructor.
     * @param string $searchText
     * @param string $appVersion
     */
    public function __construct($searchText, $appVersion)
    {
        $this->searchText = $searchText;
        $this->appVersion = $appVersion;
    }


    /**
     * @return string
     */
    public function getSearchText(){
        return $this->searchText;
    }


    /**
     * @return string
     */
    public function getAppVersion(){
        return $this->appVersion;
    }
}

<?php


namespace Trinity\AdminBundle\Service;


use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Class AdminManager
 * @package Trinity\AdminBundle\Service
 */
class AdminManager
{

    /** @var  ContainerInterface */
    protected $container;

    /**
     * AdminManager constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }


    /**
     * @return string
     */
    public function getSerchText(){
        return $this->container->getParameter('trinity.admin.search_text');
    }


    /**
     * @return string
     */
    public function getAppVersion(){
        return $this->container->getParameter('trinity.admin.app_version');
    }
}

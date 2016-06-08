<?php

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

/**
 * Class AppKernel.
 */
class AppKernel extends Kernel
{

    /**
     * @return array
     */
    public function registerBundles()
    {
        return array(
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle()

        );
    }


    /**
     * @param LoaderInterface $loader
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__ . '/config/config.yml');
        $loader->load(__DIR__ . '/config/services.yml');
    }


    /**
     * @return string
     */
    public function getCacheDir()
    {
        return __DIR__.'/./cache';
    }


    /**
     * @return string
     */
    public function getLogDir()
    {
        return __DIR__ . '/./logs';
    }
}
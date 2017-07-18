<?php

namespace Trinity\AdminBundle;

use Knp\Bundle\GaufretteBundle\KnpGaufretteBundle;
use Knp\Bundle\MenuBundle\KnpMenuBundle;
use Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle;
use Symfony\Bundle\AsseticBundle\AsseticBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\SecurityBundle\SecurityBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Bundle\WebProfilerBundle\WebProfilerBundle;
use Symfony\Bundle\WebServerBundle\WebServerBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;
use Trinity\HtDoc\AdminBundle\HtDocAdminBundle;

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
        return [
            new FrameworkBundle(),
            new SecurityBundle(),

            //new SettingsBundle(),
            new WebServerBundle(),
            new SensioFrameworkExtraBundle(),
            new TrinityAdminBundle(),
            new HtDocAdminBundle(),
            new AsseticBundle(),
            new KnpGaufretteBundle(),
            new KnpMenuBundle(),
            new WebProfilerBundle(),
            new TwigBundle(),
        ];
    }

    /**
     * @param LoaderInterface $loader
     *
     * @throws \Exception
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

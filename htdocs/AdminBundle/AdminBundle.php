<?php
declare(strict_types=1);

namespace Trinity\AdminBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Trinity\AdminBundle\DependencyInjection\AdminExtension;

/**
 * Class AdminBundle
 */
class AdminBundle extends Bundle
{
    /**
     * @param array $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $container->addCompilerPass(AdminExtension::class);
    }


    /**
     * @return string
     */
    public function getParent(): string
    {
        return 'TrinityAdminBundle';
    }
}

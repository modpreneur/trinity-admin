<?php
declare(strict_types=1);

namespace Trinity\HtDoc\AdminBundle;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Trinity\HtDoc\AdminBundle\DependencyInjection\HtDocAdminExtension;

/**
 * Class AdminBundle
 */
class HtDocAdminBundle extends Bundle
{
    /**
     *
     */
    public function getContainerExtension(): Extension
    {
        return new HtDocAdminExtension();
    }


    /**
     * @return string
     */
    public function getParent(): string
    {
        return 'TrinityAdminBundle';
    }
}

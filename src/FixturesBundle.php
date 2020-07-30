<?php
declare(strict_types=1);

namespace PcComponentes\FixturesBundle;

use PcComponentes\FixturesBundle\DependencyInjection\FixturesRegistryCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class FixturesBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(
            new FixturesRegistryCompilerPass(),
        );
    }
}

<?php
declare(strict_types=1);

namespace PcComponentes\FixturesBundle\DependencyInjection;

use PcComponentes\FixturesBundle\Fixtures\FixturesRegistry;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

final class FixturesRegistryCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if (false === $container->has(FixturesRegistry::class)) {
            throw new \InvalidArgumentException(
                \sprintf('%s has to be defined as a service', FixturesRegistry::class),
            );
        }

        $definition = $container->findDefinition(FixturesRegistry::class);
        $taggedServices = $container->findTaggedServiceIds('pccom.fixture');

        foreach (\array_keys($taggedServices) as $serviceId) {
            $definition->addMethodCall('addFixture', [new Reference($serviceId)]);
        }
    }
}

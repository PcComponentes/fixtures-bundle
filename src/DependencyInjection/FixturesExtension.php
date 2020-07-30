<?php
declare(strict_types=1);

namespace PcComponentes\FixturesBundle\DependencyInjection;

use PcComponentes\FixturesBundle\Fixtures\Fixture;
use PcComponentes\FixturesBundle\Fixtures\FixturesRegistry;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

final class FixturesExtension extends Extension
{
    public const PCCOM_FIXTURE_TAG = 'pccom.fixture';

    public function load(array $configs, ContainerBuilder $container)
    {
        $container->register(FixturesRegistry::class, FixturesRegistry::class);

        $definition = $container->registerForAutoconfiguration(Fixture::class);
        $definition->addTag(self::PCCOM_FIXTURE_TAG);
    }
}

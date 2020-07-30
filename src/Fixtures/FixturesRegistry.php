<?php
declare(strict_types=1);

namespace PcComponentes\FixturesBundle\Fixtures;

final class FixturesRegistry implements \JsonSerializable
{
    private array $registry;

    public function __construct()
    {
        $this->registry = [];
    }

    public function addFixture(Fixture $fixture): void
    {
        $this->registry[get_class($fixture)] = new FixtureOfOneExecution($fixture);
    }

    public function execute(): void
    {
        \array_walk($this->registry, [$this, 'load']);
    }

    public function jsonSerialize(): array
    {
        return $this->registry;
    }

    private function load(Fixture $reference): void
    {
        foreach ($reference->dependants() as $theDependant) {
            $this->load($this->registry[$theDependant]);
        }

        $reference->load();
    }
}

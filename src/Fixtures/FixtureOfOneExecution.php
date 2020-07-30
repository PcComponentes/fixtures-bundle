<?php
declare(strict_types=1);

namespace PcComponentes\FixturesBundle\Fixtures;

final class FixtureOfOneExecution implements Fixture, \JsonSerializable
{
    private bool $isLoaded;
    private Fixture $fixture;

    public function __construct(Fixture $fixture)
    {
        $this->fixture = $fixture;
        $this->isLoaded = false;
    }

    public function load(): void
    {
        if (true === $this->isLoaded) {
            return;
        }

        $this->fixture->load();
        $this->isLoaded = true;
    }

    public function dependants(): array
    {
        return $this->fixture->dependants();
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => \get_class($this->fixture),
            'dependants' => $this->fixture->dependants(),
        ];
    }
}

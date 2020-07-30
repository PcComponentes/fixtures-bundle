<?php
declare(strict_types=1);

namespace PcComponentes\FixturesBundle\Fixtures;

interface Fixture
{
    public function load(): void;

    public function dependants(): array;
}

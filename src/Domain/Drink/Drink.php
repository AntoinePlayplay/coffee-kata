<?php

declare(strict_types=1);

namespace App\Domain\Drink;

abstract class Drink
{
    public int $sugar;

    public function __construct(Sugar $sugar)
    {
        $this->sugar = $sugar->numberSugar;
    }

    private function isAddingStick(): bool {
        return $this->sugar > 0;
    }

    public function getStick(): int {
        return $this->isAddingStick() ? 1 : 0;
    }
}

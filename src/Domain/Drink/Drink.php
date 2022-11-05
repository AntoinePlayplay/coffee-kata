<?php

declare(strict_types=1);

namespace App\Domain\Drink;

abstract class Drink
{
    public int $sugar;
    abstract public function getInitial(): string;

    public function __construct(Sugar $sugar)
    {
        $this->sugar = $sugar->numberSugar;
    }

    public function getSugar(): ?string
    {
        return $this->sugar > 0 ? (string) $this->sugar : null;
    }

    private function isAddingStick(): bool
    {
        return $this->sugar > 0;
    }

    public function getStick(): ?string
    {
        return $this->isAddingStick() ? '0' : null;
    }


    public function __toString(): string
    {
        return $this->getInitial() . ':' . $this->getSugar() . ':' . $this->getStick();
    }
}

<?php

declare(strict_types=1);

namespace App\Domain\Drink;

use DomainException;

class Sugar
{
    public int $numberSugar;

    public function __construct(int $numberSugar)
    {
        if (!$this->isValid($numberSugar)) {
            throw new DomainException('Bad number');
        }

        $this->numberSugar = $numberSugar;
    }

    private function isValid(?int $numberSugar): bool
    {
        return $numberSugar === 0 || $numberSugar === 1 || $numberSugar === 2;
    }
}

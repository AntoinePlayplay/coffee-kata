<?php

declare(strict_types=1);

namespace App\Domain\Drink;

class Coffee extends Drink
{
    public function getInitial(): string
    {
        return 'C';
    }
}

<?php

declare(strict_types=1);

namespace App\Domain\Drink;

class Chocolate extends Drink
{
    public function getInitial(): string
    {
        return 'H';
    }
}

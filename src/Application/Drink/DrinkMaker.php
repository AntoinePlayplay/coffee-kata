<?php

declare(strict_types=1);

namespace App\Application\Drink;

use App\Domain\Drink\Drink;

final class DrinkMaker
{
    public function sendOrder(Drink $drink): string
    {
        return $drink->__toString();
    }
}

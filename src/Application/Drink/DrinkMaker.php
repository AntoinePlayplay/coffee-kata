<?php

declare(strict_types=1);

namespace App\Application\Drink;

use App\Domain\Drink\Chocolate;
use App\Domain\Drink\Coffee;
use App\Domain\Drink\Drink;
use App\Domain\Drink\Sugar;
use App\Domain\Drink\Tea;

final class DrinkMaker
{
    public function sendOrder(string $drinkType, int $numberOfSugar): string
    {
        $drink = $this->getDrink($drinkType, $numberOfSugar);

        return $drink->__toString();
    }

    public function getDrink(string $drinkType, int $numberOfSugar): Drink
    {
        switch ($drinkType) {
            default:
            case 'C':
                return new Coffee(new Sugar($numberOfSugar));
            case 'H':
                return new Chocolate(new Sugar($numberOfSugar));
            case 'T':
                return new Tea(new Sugar($numberOfSugar));
        }
    }
}

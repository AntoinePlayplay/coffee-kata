<?php

declare(strict_types=1);

namespace App\Application\Drink;

use App\Domain\Drink\Chocolate;
use App\Domain\Drink\Coffee;
use App\Domain\Drink\Drink;
use App\Domain\Drink\Sugar;
use App\Domain\Drink\Tea;

final class DrinkDeserializer
{
    public function getDrink(string $drinkType, int $numberOfSugar): Drink
    {
        return match ($drinkType) {
            'C' => new Coffee(new Sugar($numberOfSugar)),
            'H' => new Chocolate(new Sugar($numberOfSugar)),
            'T' => new Tea(new Sugar($numberOfSugar)),
            default => throw new BadDrinkTypeException("Bad drink type: $drinkType"),
        };
    }
}

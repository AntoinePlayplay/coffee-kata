<?php

declare(strict_types=1);

namespace App\Application;

use App\Application\Drink\DrinkMaker;
use Exception;

final class CoffeeMachine
{
    private DrinkMaker $drinkMaker;

    public function __construct(DrinkMaker $drinkMaker)
    {
        $this->drinkMaker = $drinkMaker;
    }

    public function sendOrder(string $drinkType, int $numberOfSugar): string
    {
        try {
            return $this->drinkMaker->sendOrder($drinkType, $numberOfSugar);
        } catch (Exception) {
            return "M:$drinkType";
        }
    }
}

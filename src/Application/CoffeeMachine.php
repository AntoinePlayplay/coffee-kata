<?php

declare(strict_types=1);

namespace App\Application;

use App\Application\Drink\DrinkDeserializer;
use App\Application\Drink\DrinkMaker;
use App\Domain\Order\OrderChecker;
use Exception;

final class CoffeeMachine
{
    private DrinkMaker $drinkMaker;

    private DrinkDeserializer $drinkDeserializer;

    private OrderChecker $orderChecker;

    public function __construct(
        DrinkMaker $drinkMaker,
        DrinkDeserializer $drinkDeserializer,
        OrderChecker $orderChecker,
    )
    {
        $this->drinkMaker = $drinkMaker;
        $this->drinkDeserializer = $drinkDeserializer;
        $this->orderChecker = $orderChecker;
    }

    public function sendOrder(string $drinkType, int $numberOfSugar, float $totalMoney): array
    {
        try {
            $drink = $this->drinkDeserializer->getDrink($drinkType, $numberOfSugar);

            $messages = [];
            $remainingMoney = $this->orderChecker->getRemainingMoney($drink, $totalMoney);
            if ($remainingMoney >= 0) {
                $messages[] = $this->drinkMaker->sendOrder($drink);

                if ($remainingMoney > 0) {
                    $messages[] = $this->getMessage("Returning money: $remainingMoney");
                }
            } else {
                $messages[] = $this->getMessage('Not enough money');
            }
            return $messages;
        } catch (Exception) {
            return [$this->getMessage($drinkType)];
        }
    }

     private function getMessage($message): string
     {
         return "M:$message";
     }
}

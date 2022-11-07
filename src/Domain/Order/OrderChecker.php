<?php

declare(strict_types=1);

namespace App\Domain\Order;

use App\Domain\Drink\Drink;

final class OrderChecker
{
    private function orderList(Drink $drink): float
    {
        // TODO: This is a bit straightforward for mapping the price
        $menu = [
            'C' => 0.6,
            'H' => 0.5,
            'T' => 0.4,
        ];
        return $menu[$drink->getInitial()];
    }

    public function getRemainingMoney(Drink $drink, float $money): float
    {
        return $money - $this->orderList($drink);
    }
}

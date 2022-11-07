<?php

declare(strict_types=1);

namespace App\Tests\Domain\Order;

use App\Domain\Drink\Chocolate;
use App\Domain\Drink\Coffee;
use App\Domain\Drink\Drink;
use App\Domain\Drink\Sugar;
use App\Domain\Drink\Tea;
use App\Domain\Order\OrderChecker;
use PHPUnit\Framework\TestCase;

class OrderCheckerTest extends TestCase
{
    private OrderChecker $sut;

    public function setUp(): void
    {
        $this->sut = new OrderChecker();
    }

    private function order(): array
    {
        return [
            [new Coffee(new Sugar(0)), 0.6],
            [new Chocolate(new Sugar(0)), 0.5],
            [new Tea(new Sugar(0)), 0.4],
        ];
    }

    /** @dataProvider order */
    public function testOrderMoneyHasEnoughMoneyForACoffee(Drink $drink, float $money): void
    {
        // Act
        $hasEnoughMoney = $this->sut->hasEnoughMoney($drink, $money);

        // Assert
        $this->assertTrue($hasEnoughMoney);
    }

    private function moreMoneyOrder(): array
    {
        return [
            [new Coffee(new Sugar(0)), 1],
            [new Chocolate(new Sugar(0)), 1],
            [new Tea(new Sugar(0)), 1],
        ];
    }

    /** @dataProvider moreMoneyOrder */
    public function testOrderMoneyHasMoreMoneyForACoffee(Drink $drink, float $money): void
    {
        // Act
        $hasEnoughMoney = $this->sut->hasEnoughMoney($drink, $money);

        // Assert
        $this->assertTrue($hasEnoughMoney);
    }

    private function badOrder(): array
    {
        return [
            [new Coffee(new Sugar(0)), 0.2],
            [new Chocolate(new Sugar(0)), 0.2],
            [new Tea(new Sugar(0)), 0.2],
        ];
    }

    /** @dataProvider badOrder */
    public function testOrderMoneyHasNotEnoughMoneyForACoffee(Drink $drink, float $money): void
    {
        // Act
        $hasEnoughMoney = $this->sut->hasEnoughMoney($drink, $money);

        // Assert
        $this->assertFalse($hasEnoughMoney);
    }
}

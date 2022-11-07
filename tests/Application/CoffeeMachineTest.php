<?php

declare(strict_types=1);

namespace App\Tests\Application;

use App\Application\CoffeeMachine;
use App\Application\Drink\DrinkDeserializer;
use App\Application\Drink\DrinkMaker;
use App\Domain\Order\OrderChecker;
use PHPUnit\Framework\TestCase;

class CoffeeMachineTest extends TestCase
{
    private CoffeeMachine $sut;

    public function setUp(): void
    {
        $this->sut = new CoffeeMachine(new DrinkMaker(), new DrinkDeserializer(), new OrderChecker());
    }

    public function drinkType(): array
    {
        return [['C'], ['H'], ['T']];
    }

    /** @dataProvider drinkType */
    public function testItReturnsTheOrderForADrinkWithNoSugar($drinkType): void
    {
        // Act
        $order = $this->sut->sendOrder($drinkType, 0, 0.6);

        // Assert
        $this->assertSame(["$drinkType::"], $order);
    }

    /** @dataProvider drinkType */
    public function testItReturnsTheOrderForADrinkWith2Sugar($drinkType): void
    {
        // Act
        $order = $this->sut->sendOrder($drinkType, 2, 0.6);

        // Assert
        $this->assertSame(["$drinkType:2:0"], $order);
    }

    /** @dataProvider drinkType */
    public function testItReturnsTheOrderForADrinkWithoutMoney($drinkType): void
    {
        // Act
        $order = $this->sut->sendOrder($drinkType, 2, 0);

        // Assert
        $this->assertSame(['M:Not enough money'], $order);
    }


    public function messageCustomer(): array
    {
        return [['X'], ["I'm sorry"], ['Hello world!']];
    }

    /** @dataProvider messageCustomer */
    public function testItReturnsAMessageWhenTheOrderIsAnUnknownDrink($messageCustomer): void
    {
        // Act
        $message = $this->sut->sendOrder($messageCustomer, 0, 0);

        // Assert
        $this->assertSame(["M:$messageCustomer"], $message);
    }
}

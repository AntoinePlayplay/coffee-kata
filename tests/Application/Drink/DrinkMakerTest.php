<?php

declare(strict_types=1);

namespace App\Tests\Application\Drink;

use App\Application\Drink\BadDrinkTypeException;
use App\Application\Drink\DrinkMaker;
use PHPUnit\Framework\TestCase;

class DrinkMakerTest extends TestCase
{
    private DrinkMaker $sut;

    public function setUp(): void
    {
        $this->sut = new DrinkMaker();
    }

    public function drinkInitial(): array
    {
        return [['C'], ['H'], ['T']];
    }

    /** @dataProvider drinkInitial */
    public function testItReturnsTheOrderForADrinkWith2Sugar($drinkInitial): void
    {
        // Act
        $order = $this->sut->sendOrder($drinkInitial, 2);

        // Assert
        $this->assertSame("$drinkInitial:2:0", $order);
    }

    /** @dataProvider drinkInitial */
    public function testItReturnsTheOrderForADrinkWith1Sugar($drinkInitial): void
    {
        // Act
        $order = $this->sut->sendOrder($drinkInitial, 1);

        // Assert
        $this->assertSame("$drinkInitial:1:0", $order);
    }

    /** @dataProvider drinkInitial */
    public function testItReturnsTheOrderForADrinkWithNoSugar($drinkInitial): void
    {
        // Act
        $order = $this->sut->sendOrder($drinkInitial, 0);

        // Assert
        $this->assertSame("$drinkInitial::", $order);
    }

    public function testItThrowsBadDrinkTypeExceptionWhenTheOrderIsAnUnknownDrink(): void
    {
        // Assert
        $this->expectException(BadDrinkTypeException::class);

        // Act
        $this->sut->sendOrder('X', 0);
    }
}

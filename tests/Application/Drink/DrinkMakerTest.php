<?php

declare(strict_types=1);

namespace App\Tests\Application\Drink;

use App\Application\Drink\DrinkMaker;
use App\Domain\Drink\Chocolate;
use App\Domain\Drink\Coffee;
use App\Domain\Drink\Drink;
use App\Domain\Drink\Sugar;
use App\Domain\Drink\Tea;
use PHPUnit\Framework\TestCase;

class DrinkMakerTest extends TestCase
{
    private DrinkMaker $sut;

    public function setUp(): void
    {
        $this->sut = new DrinkMaker();
    }

    public function drink(): array
    {
        return [[new Coffee(new Sugar(2))], [new Chocolate(new Sugar(2))], [new Tea(new Sugar(2))]];
    }

    /** @dataProvider drink */
    public function testItReturnsTheOrderForADrinkWith2Sugar(Drink $drink): void
    {
        // Act
        $order = $this->sut->sendOrder($drink);

        // Assert
        $this->assertSame("{$drink->getInitial()}:2:0", $order);
    }
}

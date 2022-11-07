<?php

declare(strict_types=1);

namespace App\Tests\Application\Drink;

use App\Application\Drink\BadDrinkTypeException;
use App\Application\Drink\DrinkDeserializer;
use App\Application\Drink\DrinkMaker;
use App\Domain\Drink\Chocolate;
use App\Domain\Drink\Coffee;
use App\Domain\Drink\Tea;
use PHPUnit\Framework\TestCase;

class DrinkDeserializerTest extends TestCase
{
    private DrinkDeserializer $sut;

    public function setUp(): void
    {
        $this->sut = new DrinkDeserializer();
    }

    public function testItDeserializeACoffee(): void
    {
        // Act
        $coffee = $this->sut->getDrink('C', 0);

        // Assert
        $this->assertSame(Coffee::class, $coffee::class);
    }

    public function testItDeserializeAChocolate(): void
    {
        // Act
        $chocolate = $this->sut->getDrink('H', 0);

        // Assert
        $this->assertSame(Chocolate::class, $chocolate::class);
    }

    public function testItDeserializeATea(): void
    {
        // Act
        $tea = $this->sut->getDrink('T', 0);

        // Assert
        $this->assertSame(Tea::class, $tea::class);
    }

    public function testItDeserializeATeaWith2Sugar(): void
    {
        // Act
        $tea = $this->sut->getDrink('T', 2);

        // Assert
        $this->assertSame(2, $tea->sugar);
    }

    public function testItThrowsBadDrinkTypeExceptionWhenTheOrderIsAnUnknownDrink(): void
    {
        // Assert
        $this->expectException(BadDrinkTypeException::class);

        // Act
        $this->sut->getDrink('X', 0);
    }
}

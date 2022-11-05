<?php

namespace App\Tests\Domain;

use App\Domain\Drink\Chocolate;
use App\Domain\Drink\Coffee;
use App\Domain\Drink\Sugar;
use App\Domain\Drink\Tea;
use PHPUnit\Framework\TestCase;

class DrinkTest extends TestCase
{
    public function testItGetAStickForCoffeeWhenSugarNumberIsGreaterThan0(): void
    {
        // Arrange
        $coffee = new Coffee(new Sugar(1));

        // Act && Assert
        $this->assertSame('0', $coffee->getStick());
    }

    public function testItGetNoStickForCoffeeWhenSugarNumberIs0(): void
    {
        // Arrange
        $coffee = new Coffee(new Sugar(0));

        // Act && Assert
        $this->assertNull($coffee->getStick());
    }

    public function testItGet1StickForChocolateWhenSugarNumberIsGreaterThan0(): void
    {
        // Arrange
        $chocolate = new Chocolate(new Sugar(1));

        // Act && Assert
        $this->assertSame('0', $chocolate->getStick());
    }

    public function testItGetNoStickForChocolateWhenSugarNumberIs0(): void
    {
        // Arrange
        $chocolate = new Chocolate(new Sugar(0));

        // Act && Assert
        $this->assertNull($chocolate->getStick());
    }

    public function testItGet1StickForTeaWhenSugarNumberIsGreaterThan0(): void
    {
        // Arrange
        $tea = new Tea(new Sugar(1));

        // Act && Assert
        $this->assertSame('0', $tea->getStick());
    }

    public function testItGetNoStickForTeaWhenSugarNumberIs0(): void
    {
        // Arrange
        $tea = new Tea(new Sugar(0));

        // Act && Assert
        $this->assertNull($tea->getStick());
    }
}

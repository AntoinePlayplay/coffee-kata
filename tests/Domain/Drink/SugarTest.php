<?php

namespace App\Tests\Domain\Drink;

use App\Domain\Drink\Sugar;
use DomainException;
use PHPUnit\Framework\TestCase;

class SugarTest extends TestCase
{
    /**
     * @dataProvider getNumberSugar
     */
    public function testNumberSugarCanBeAdded(?int $getNumberSugar): void
    {
        $sugar = new Sugar($getNumberSugar);
        $this->assertSame($getNumberSugar, $sugar->numberSugar);
    }

    private function getNumberSugar(): array
    {
        return [[0], [1], [2]];
    }

    /**
     * @dataProvider getBadNumberSugar
     */
    public function testItThrowsDomainExceptionWhenNumberSugarIsNotRight(int $getBadNumberSugar): void
    {
        // Assert
        $this->expectException(DomainException::class);

        // Act
        $sugar = new Sugar($getBadNumberSugar);
    }

    private function getBadNumberSugar(): array
    {
        return [[-1], [3], [10]];
    }
}

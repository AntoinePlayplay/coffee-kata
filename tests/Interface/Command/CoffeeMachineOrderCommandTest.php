<?php

namespace App\Tests\Interface\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

final class CoffeeMachineOrderCommandTest extends KernelTestCase
{
    private CommandTester $sut;

    public function setUp(): void
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find('coffee-machine:order');
        $this->sut = new CommandTester($command);
    }

    public function testItExecutesSuccessfullyWithRightDrinkOrder(): void
    {
        // Act
        $this->sut->execute(['drinkType' => 'C', 'numberOfSugar' => '1']);

        // Assert
        $this->sut->assertCommandIsSuccessful();

        // the output of the command in the console
        $output = $this->sut->getDisplay();
        $this->assertStringContainsString('C:1:0', $output);
    }

    public function xtestItReturnFailureWithBadDrinkOrder(): void
    {
        $this->sut->execute(['drinkType' => 'X']);

        $this->assertSame(1, $this->sut->getStatusCode());
    }
}

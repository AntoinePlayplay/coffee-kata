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
        $this->sut->execute([ 'money' => '0.6', 'drinkType' => 'C', 'numberOfSugar' => '1',]);

        // Assert
        $this->sut->assertCommandIsSuccessful();

        // the output of the command in the console
        $output = $this->sut->getDisplay();
        $this->assertStringContainsString('C:1:0', $output);
    }

    public function testItExecutesWithRightDrinkOrderButWithNotEnoughMoney(): void
    {
        // Act
        $this->sut->execute([ 'money' => '0.1', 'drinkType' => 'C', 'numberOfSugar' => '1',]);

        // Assert
        $this->sut->assertCommandIsSuccessful();

        // the output of the command in the console
        $output = $this->sut->getDisplay();
        $this->assertStringContainsString('M:Not enough money', $output);
    }

    public function testItReturnAMessageWithBadDrinkOrder(): void
    {
        // Act
        $this->sut->execute(['drinkType' => 'Hello world!', 'money' => '0']);

        // Assert
        $this->sut->assertCommandIsSuccessful();

        // the output of the command in the console
        $output = $this->sut->getDisplay();
        $this->assertStringContainsString('M:Hello world!', $output);
    }
}

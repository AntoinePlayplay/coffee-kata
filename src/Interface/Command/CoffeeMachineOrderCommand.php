<?php

declare(strict_types=1);

namespace App\Interface\Command;

use App\Application\CoffeeMachine;
use App\Application\Drink\DrinkMaker;
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'coffee-machine:order')]
class CoffeeMachineOrderCommand extends Command
{
    private CoffeeMachine $coffeeMachine;

    public function __construct(CoffeeMachine $coffeeMachine)
    {
        $this->coffeeMachine = $coffeeMachine;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $order = $this->coffeeMachine->sendOrder(
                $input->getArgument('drinkType'),
                (int) $input->getArgument('numberOfSugar')
            );
            $output->writeln($order);
            return Command::SUCCESS;
        } catch (Exception) {
            return Command::FAILURE;
        }
    }

    protected function configure(): void
    {
        $this
            ->addArgument('drinkType', InputArgument::REQUIRED , 'Drink type')
            ->addArgument('numberOfSugar', InputArgument::OPTIONAL , 'Number of sugar');
    }
}

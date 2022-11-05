<?php

declare(strict_types=1);

namespace App\Domain\Drink;

class Tea extends Drink
{
    public function getInitial(): string
    {
        return 'T';
    }
}

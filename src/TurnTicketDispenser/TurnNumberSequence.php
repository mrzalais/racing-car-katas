<?php

declare(strict_types=1);

namespace RacingCar\TurnTicketDispenser;

class TurnNumberSequence
{
    private int $turnNumber = 0;

    public function nextTurn(): int
    {
        ++$this->turnNumber;
        return $this->turnNumber;
    }
}

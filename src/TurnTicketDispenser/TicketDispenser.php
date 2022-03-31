<?php

declare(strict_types=1);

namespace RacingCar\TurnTicketDispenser;

class TicketDispenser
{
    public function getTurnTicket(int $currentTurn): TurnTicket
    {
        return new TurnTicket($currentTurn);
    }
}

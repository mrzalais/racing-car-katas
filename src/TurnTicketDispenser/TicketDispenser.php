<?php

declare(strict_types=1);

namespace RacingCar\TurnTicketDispenser;

class TicketDispenser
{
    private TurnNumberSequence $turnNumberSequence;

    public function __construct(TurnNumberSequence $turnNumberSequence)
    {
        $this->turnNumberSequence = $turnNumberSequence;
    }

    public function getTurnTicket(): TurnTicket
    {
        return new TurnTicket($this->turnNumberSequence->nextTurn());
    }
}

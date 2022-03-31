<?php

declare(strict_types=1);

namespace Tests\TurnTicketDispenser;

use PHPUnit\Framework\TestCase;
use RacingCar\TurnTicketDispenser\TicketDispenser;
use RacingCar\TurnTicketDispenser\TurnNumberSequence;

class TicketDispenserTest extends TestCase
{
    public function testGetNewTicket(): void
    {
        $dispenser = new TicketDispenser();
        $turnNumberSequence = new TurnNumberSequence;

        $ticket = $dispenser->getTurnTicket($turnNumberSequence->nextTurn());
        $this->assertSame(1, $ticket->getTurnNumber());
    }

    public function testGetMultipleTickets(): void
    {
        $dispenser = new TicketDispenser();
        $turnNumberSequence = new TurnNumberSequence;

        $ticket = $dispenser->getTurnTicket($turnNumberSequence->nextTurn());
        $this->assertSame(1, $ticket->getTurnNumber());

        $ticket = $dispenser->getTurnTicket($turnNumberSequence->nextTurn());
        $this->assertSame(2, $ticket->getTurnNumber());
    }
}

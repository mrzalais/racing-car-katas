<?php

declare(strict_types=1);

namespace Tests\TelemetrySystem;

use Exception;
use PHPUnit\Framework\TestCase;
use RacingCar\TelemetrySystem\TelemetryClient;
use RacingCar\TelemetrySystem\TelemetryDiagnosticControls;

class TelemetryDiagnosticControlsTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testCheckTransmissionShouldSendAndReceiveDiagnosticMessage(): void
    {
        $telemetryClientMock = $this->createPartialMock(
            TelemetryClient::class,
            ['getOnlineStatus']
        );
        $telemetryClientMock->method('getOnlineStatus')->willReturn(true);

        $telemetryDiagnosticControls = new TelemetryDiagnosticControls($telemetryClientMock);

        $telemetryDiagnosticControls->checkTransmissionSend();
        $this->assertEquals(true, $telemetryDiagnosticControls->telemetryClient->getDiagnosticMessageWasSent());

        $telemetryDiagnosticControls->checkTransmissionReceive();
        $this->assertEquals(false, $telemetryDiagnosticControls->telemetryClient->getDiagnosticMessageWasSent());
    }
}

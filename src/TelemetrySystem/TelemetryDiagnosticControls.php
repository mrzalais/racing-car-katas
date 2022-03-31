<?php

declare(strict_types=1);

namespace RacingCar\TelemetrySystem;

use Exception;
use RuntimeException;

class TelemetryDiagnosticControls
{
    public const DIAGNOSTIC_CHANNEL_CONNECTION_STRING = '*111#';

    public string $diagnosticInfo = '';

    public TelemetryClient $telemetryClient;

    public function __construct(TelemetryClient $telemetryClient)
    {
        $this->telemetryClient = $telemetryClient;
    }

    /**
     * @throws Exception
     */
    public function checkTransmissionSend(): void
    {
        $this->prepareTransmission();

        $this->telemetryClient->send(TelemetryClient::DIAGNOSTIC_MESSAGE);
    }

    /**
     * @throws Exception
     */
    public function checkTransmissionReceive(): void
    {
        $this->prepareTransmission();

        $this->diagnosticInfo = $this->telemetryClient->receive();
    }

    /**
     * @throws Exception
     */
    private function prepareTransmission(): void
    {
        $this->telemetryClient->disconnect();

        $retryLeft = 3;
        while ($this->telemetryClient->getOnlineStatus() === false and $retryLeft > 0) {
            $this->telemetryClient->connect(self::DIAGNOSTIC_CHANNEL_CONNECTION_STRING);
            --$retryLeft;
        }

        if ($this->telemetryClient->getOnlineStatus() === false) {
            throw new RuntimeException('Unable to connect.');
        }
    }
}

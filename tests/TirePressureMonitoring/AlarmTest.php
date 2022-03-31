<?php

declare(strict_types=1);

namespace Tests\TirePressureMonitoring;

use PHPUnit\Framework\TestCase;
use RacingCar\TirePressureMonitoring\Alarm;
use RacingCar\TirePressureMonitoring\Sensor;

class AlarmTest extends TestCase
{
    /**
     * @dataProvider provider
     */
    public function testItChecksWhetherAlarmIsActiveWithGivenPressure(int $pressure, bool $expectedAlarmState): void
    {
        $sensorMock = $this->createMock(Sensor::class);
        $sensorMock->method('popNextPressurePsiValue')->willReturn($pressure);

        $alarm = new Alarm($sensorMock);
        $alarm->check();

        $this->assertEquals($expectedAlarmState, $alarm->isAlarmOn());
    }

    public function provider(): array
    {
        return [
            [16, true], //Pressure too low
            [17, false],
            [18, false],
            [19, false],
            [20, false],
            [21, false],
            [22, true], //Pressure too high
        ];
    }
}
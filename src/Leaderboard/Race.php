<?php

declare(strict_types=1);

namespace RacingCar\Leaderboard;

class Race
{
    private static $points = [25, 18, 15];

    private string $name;

    private array$drivers;

    private array $driverNames;

    /**
     * @param Driver[]  $drivers
     */
    public function __construct(string $name, array $drivers)
    {
        $this->name = $name;
        $this->drivers = $drivers;
        $this->driverNames = [];

        foreach ($drivers as $driver) {
            $name = $driver->name;
            if ($driver instanceof SelfDrivingCar) {
                $name = "Self Driving Car - {$driver->country} ({$driver->algorithmVersion})";
            }
            $this->driverNames[(string) $driver] = $name;
        }
    }

    public function getPosition(Driver $driver): int|string|false
    {
        return array_search($driver, $this->drivers, true);
    }

    public function getPoints(Driver $driver): int
    {
        return self::$points[$this->getPosition($driver)];
    }

    /**
     * @return Driver[]
     */
    public function getResults(): array
    {
        return $this->drivers;
    }

    public function getDriverName(Driver $driver): string
    {
        return $this->driverNames[(string) $driver];
    }
}

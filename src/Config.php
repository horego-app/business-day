<?php

namespace Printerous\Library;

class Config
{
    private $holidays;

    public function __construct(array $holidays = [])
    {
        $this->holidays = new DateTimeArray();
        $this->addHolidays($holidays);
    }

    public function isHoliday(\DateTime $dateTime)
    {
        return $this->holidays->contains($dateTime);
    }

    public function addHoliday(\DateTime $holiday)
    {
        $this->holidays->attach($holiday);
    }

    public function addHolidays($holidays)
    {
        foreach ($holidays as $holiday) {
            $this->addHoliday($holiday);
        }
    }
}
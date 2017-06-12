<?php

namespace Printerous\Library;

use Carbon\Carbon;

class BusinessDay
{
    private $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function next(\DateTime $dateTime, $day = 1)
    {
        if ($day < 1) $day = 1;
        $result = clone $dateTime;

        for ($i = 0; $i < $day; $i++) {
            do {
                $result = Carbon::instance($result)->addDay();
            } while ($this->isHoliday($result));
        }
        return $result;
    }

    public function isHoliday(\DateTime $dateTime)
    {
        return $this->config->isHoliday($dateTime) || Carbon::instance($dateTime)->isWeekend();
    }

    public function isBusinessDay(\DateTime $dateTime)
    {
        return !$this->isHoliday($dateTime);
    }
}
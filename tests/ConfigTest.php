<?php
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use Printerous\Library\BusinessDay;
use Printerous\Library\Config;

class ConfigTest extends TestCase
{
    public function testHoliday(){
        $config = new Config([
            new \DateTime('2017-06-13'),
            new \DateTime('2017-06-15')
        ]);

        $today = new \DateTime('2017-06-13');
        $this->assertTrue($config->isHoliday($today));

        $today = new \DateTime('2017-06-14');
        $this->assertFalse($config->isHoliday($today));
    }
}
<?php
use PHPUnit\Framework\TestCase;
use Printerous\Library\BusinessDay;
use Printerous\Library\Config;

class BusinessDayTest extends TestCase
{
    public function testNextBusinessDay()
    {
        $business = new BusinessDay(new Config());
        $today = new DateTime('2017-06-08');
        $this->assertEquals(new DateTime('2017-06-09'), $business->next($today));
    }

    public function testNextBusinessDay2()
    {
        $business = new BusinessDay(new Config());
        $today = new DateTime('2017-06-09');
        $this->assertEquals(new DateTime('2017-06-12'), $business->next($today));
    }

    public function testNextBusinessDay3()
    {
        $business = new BusinessDay(new Config());
        $today = new DateTime('2017-06-10');
        $this->assertEquals(new DateTime('2017-06-12'), $business->next($today));
    }

    public function testNextBusinessDay4()
    {
        $business = new BusinessDay(new Config());
        $today = new DateTime('2017-06-11');
        $this->assertEquals(new DateTime('2017-06-12'), $business->next($today));
    }

    public function testNextBusinessDay5()
    {
        $business = new BusinessDay(new Config());
        $today = new DateTime('2017-06-12');
        $this->assertEquals(new DateTime('2017-06-13'), $business->next($today));
    }

    public function testNextBusinessDay6()
    {
        $holidays = [
            new DateTime('2017-06-13')
        ];
        $business = new BusinessDay(new Config($holidays));
        $today = new DateTime('2017-06-12');
        $this->assertEquals(new DateTime('2017-06-14'), $business->next($today));
    }

    public function testNextBusinessDay7()
    {
        $holidays = [
            new DateTime('2017-06-13')
        ];
        $business = new BusinessDay(new Config($holidays));
        $today = new DateTime('2017-06-13');
        $this->assertEquals(new DateTime('2017-06-14'), $business->next($today));
    }

    public function testNextBusinessDay8()
    {
        $holidays = [
            new DateTime('2017-06-13'),
            new DateTime('2017-06-14')
        ];
        $business = new BusinessDay(new Config($holidays));
        $today = new DateTime('2017-06-13');
        $this->assertEquals(new DateTime('2017-06-15'), $business->next($today));
    }

    public function testNextBusinessDay9()
    {
        $business = new BusinessDay(new Config());
        $today = new DateTime('2017-06-10');
        $this->assertEquals(new DateTime('2017-06-14'), $business->next($today, 3));
    }

    public function testNextBusinessDay10()
    {
        $holidays = [
            new DateTime('2017-06-13'),
            new DateTime('2017-06-14')
        ];
        $business = new BusinessDay(new Config($holidays));
        $today = new DateTime('2017-06-13');
        $this->assertEquals(new DateTime('2017-06-16'), $business->next($today, 2));
    }

    public function testNextBusinessDay11()
    {
        $holidays = [
            new DateTime('2017-06-13'),
            new DateTime('2017-06-15')
        ];
        $business = new BusinessDay(new Config($holidays));
        $today = new DateTime('2017-06-12');
        $this->assertEquals(new DateTime('2017-06-16'), $business->next($today, 2));
    }
}
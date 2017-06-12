# Business Day

Date calculation based on business caledars

## Installation

```bash
$ composer require printerous/business-day
```

## Usage

```php
$business = new BusinessDay(new Config());
$today = new DateTime('2017-06-08');
$business->next($today); // '2017-06-09'
$business->next($today, 2); // '2017-06-12'

//Set holidays
$holidays = [
    new DateTime('2017-06-13'),
    new DateTime('2017-06-14')
];
$business = new BusinessDay(new Config($holidays));
$today = new DateTime('2017-06-13');
$business->next($today); // '2017-06-15'
```

<?php

namespace Printerous\Library;

use SplObjectStorage;

class DateTimeArray extends SplObjectStorage
{
    public function getHash($object): string
    {
        return $object->format('Y-m-d');
    }
}

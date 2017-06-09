<?php

namespace Printerous\Library;

use SplObjectStorage;

class DateTimeArray extends SplObjectStorage
{
    public function getHash($object)
    {
        return $object->format('Y-m-d');
    }
}
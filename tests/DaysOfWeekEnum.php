<?php

namespace MadWeb\Enum\Test;

use MadWeb\Enum\Enum;
use MadWeb\Enum\CastToIntegerConstructor;

final class DaysOfWeekEnum extends Enum
{
    use CastToIntegerConstructor;

    // For unit-test purpose the default is not set to sunday, to test null as input results in actual default value and
    // not due to a non-strict comparison null == 0
    const __default = self::MONDAY;

    const SUNDAY = 0;
    const MONDAY = 1;
    const TUESDAY = 2;
    const WEDNESDAY = 3;
    const THURSDAY = 4;
    const FRIDAY = 5;
    const SATURDAY = 6;
}

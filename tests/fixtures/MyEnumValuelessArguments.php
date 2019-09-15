<?php

namespace App\Enums;

use MadWeb\Enum\Enum;

/**
 * @method static MyEnumValuelessArguments SMALL()
 * @method static MyEnumValuelessArguments MEDIUM()
 * @method static MyEnumValuelessArguments LARGE()
 */
final class MyEnumValuelessArguments extends Enum
{
    public const __default = self::SMALL;

    public const SMALL = 0;
    public const MEDIUM = 1;
    public const LARGE = 2;
}

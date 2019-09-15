<?php

namespace App\Enums;

use MadWeb\Enum\Enum;

/**
 * @method static MyEnumNoArguments FOO()
 * @method static MyEnumNoArguments BAR()
 * @method static MyEnumNoArguments BAZ()
 */
final class MyEnumNoArguments extends Enum
{
    public const __default = self::FOO;

    public const FOO = 0;
    public const BAR = 1;
    public const BAZ = 2;
}

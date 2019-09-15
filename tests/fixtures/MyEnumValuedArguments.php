<?php

namespace App\Enums;

use MadWeb\Enum\Enum;

/**
 * @method static MyEnumValuedArguments SMALL()
 * @method static MyEnumValuedArguments MEDIUM()
 * @method static MyEnumValuedArguments LARGE()
 */
final class MyEnumValuedArguments extends Enum
{
    public const __default = self::SMALL;

    public const SMALL = 's';
    public const MEDIUM = 'm';
    public const LARGE = 'l';
}

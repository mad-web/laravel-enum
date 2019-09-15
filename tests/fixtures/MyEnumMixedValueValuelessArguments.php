<?php

namespace App\Enums;

use MadWeb\Enum\Enum;

/**
 * @method static MyEnumMixedValueValuelessArguments WITH1()
 * @method static MyEnumMixedValueValuelessArguments WITHOUT1()
 * @method static MyEnumMixedValueValuelessArguments WITH2()
 * @method static MyEnumMixedValueValuelessArguments WITHOUT2()
 * @method static MyEnumMixedValueValuelessArguments WITHOUT3()
 * @method static MyEnumMixedValueValuelessArguments WITH3()
 */
final class MyEnumMixedValueValuelessArguments extends Enum
{
    public const __default = self::WITH1;

    public const WITH1 = 'with1';
    public const WITHOUT1 = 0;
    public const WITH2 = 'with2';
    public const WITHOUT2 = 1;
    public const WITHOUT3 = 2;
    public const WITH3 = 'with3';
}

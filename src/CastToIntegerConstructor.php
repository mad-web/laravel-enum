<?php

namespace MadWeb\Enum;

/**
 * Trait CastToIntegerConstructor to support using a string as value to create the enum, while the enum value is an
 * integer.
 *
 * This trait solves the issue the Enum cannot be constructed in EnumCastable used in a model while using a integer enum
 * value. Some database drivers return integers as integer while other returns them as string.
 *
 * For example the PHP MySQL native driver return integers, while other drivers return strings.
 * See the issue https://github.com/laravel/framework/issues/11780 which describes this as well.
 *
 * Please note it's not recommended to use constructors in traits, since constructors should be specific to a class to
 * which they belong. Another solution can be to add a boolean castToInteger on the enum class.
 */
trait CastToIntegerConstructor
{
    /**
     * Creates a new value of some type, with casting the supplied value to an integer if the value is present in a
     * non-strict comparison with the values.
     *
     * @param mixed $value
     *
     * @throws \UnexpectedValueException if incompatible type is given.
     */
    public function __construct($value = null)
    {
        // Use the default value when no value is supplied, this cannot be omitted due to
        // non-strict comparison null == 0, resulting in the integer 0.
        if (is_null($value)) {
            $value = static::__default;
        }

        // Verify the supplied value is present when we don't check for the type.
        if (\in_array($value, static::toArray(), false)) {
            $value = (int) $value;
        }

        parent::__construct($value);
    }
}

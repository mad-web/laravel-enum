<?php

namespace MadWeb\Enum\Rules;

use Illuminate\Contracts\Validation\Rule;
use InvalidArgumentException;
use MadWeb\Enum\Enum;

class EnumRule implements Rule
{
    private $enumClass = '';

    /**
     * @var bool true if the the key of the enum should be used to validate against, otherwise the value is used.
     */
    private $useKey = false;

    /**
     * Create a new rule instance.
     *
     * @param string $enumClass The enum class to create the the rule for
     * @param bool $useKey true if the enum key should be used to validate against, otherwise the value is used.
     *
     * @return void
     */
    public function __construct(string $enumClass, bool $useKey = false)
    {
        if (! is_subclass_of($enumClass, Enum::class)) {
            throw new InvalidArgumentException("Value '$enumClass' is not an enum class");
        }

        $this->useKey = $useKey;
        $this->enumClass = $enumClass;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return call_user_func([$this->enumClass, $this->useKey ? 'isValidKey' : 'isValid'], $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans()->has('validation.enum')
                ? __('validation.enum')
                : 'The :attribute value you have entered is invalid.';
    }
}

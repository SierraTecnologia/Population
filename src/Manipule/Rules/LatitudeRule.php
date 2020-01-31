<?php

namespace Population\Manipule\Rules;

use App\ValueObjects\Latitude;
use Illuminate\Contracts\Validation\Rule;
use InvalidArgumentException;

/**
 * Class LatitudeRule.
 *
 * @package Population\Manipule\Rules
 */
class LatitudeRule implements Rule
{
    /**
     * @inheritdoc
     */
    public function passes($attribute, $value)
    {
        try {
            new Latitude($value);
            return true;
        } catch (InvalidArgumentException $e) {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function message()
    {
        return __('validation.latitude');
    }
}

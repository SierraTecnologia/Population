<?php

namespace Population\Manipule\Managers\User;

use App\Contants\Tables;
use App\Models\User;
use Illuminate\Validation\Factory as ValidatorFactory;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use function SiUtils\Helper\validator_filter_attributes;

/**
 * Class UserValidator.
 *
 * @package Population\Manipule\Managers\User
 */
class UserValidator
{
    /**
     * @var ValidatorFactory
     */
    private $validatorFactory;

    /**
     * SubscriptionValidator constructor.
     *
     * @param ValidatorFactory $validatorFactory
     */
    public function __construct(ValidatorFactory $validatorFactory)
    {
        $this->validatorFactory = $validatorFactory;
    }

    /**
     * @param  array $attributes
     * @return array
     * @throws ValidationException
     */
    public function validateForCreate(array $attributes): array
    {
        $validRoleIdRule = Rule::exists(Tables::TABLE_ROLES, 'id');
        $uniqueUserEmailRule = Rule::unique(Tables::TABLE_USERS, 'email');

        $rules = [
            'role_id' => ['required', $validRoleIdRule],
            'email' => ['required', 'email', 'min:1', 'max:255', $uniqueUserEmailRule],
            'name' => ['required', 'min:1', 'max:255'],
            'password' => ['required', 'min:1', 'max:255'],
        ];

        $this->validatorFactory->validate($attributes, $rules);

        return validator_filter_attributes($attributes, $rules);
    }

    /**
     * @param  User  $user
     * @param  array $attributes
     * @return array
     * @throws ValidationException
     */
    public function validateForSave(User $user, array $attributes): array
    {
        $uniqueUserEmailRule = Rule::unique(Tables::TABLE_USERS, 'email')->ignore($user->id, 'id');

        $rules = [
            'email' => ['filled', 'min:1', 'max:255', $uniqueUserEmailRule],
            'name' => ['filled', 'min:1', 'max:255'],
            'password' => ['filled', 'min:1', 'max:255'],
        ];

        $this->validatorFactory->validate($attributes, $rules);

        return validator_filter_attributes($attributes, $rules);
    }
}

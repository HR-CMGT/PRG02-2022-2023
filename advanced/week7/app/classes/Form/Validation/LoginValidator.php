<?php namespace MusicCollection\Form\Validation;

use MusicCollection\Databases\Objects\User;

/**
 * Class LoginValidator
 * @package MusicCollection\Form\Validation
 */
class LoginValidator implements Validator
{
    private array $errors = [];

    /**
     * LoginValidator constructor.
     *
     * @param User $user
     * @param string $password
     */
    public function __construct(private readonly User $user, private readonly string $password)
    {
    }

    /**
     * Validate the data
     */
    public function validate(): void
    {
        //Go on if we got an user (which means email is correct)
        if (!empty($this->user->email) && !empty($this->user->password)) {
            //Validate password
            if (!password_verify($this->password, $this->user->password)) {
                $this->errors[] = 'Your login credentials are incorrect.';
            }
        } else {
            $this->errors[] = 'Your login credentials are incorrect.';
        }
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}

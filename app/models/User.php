<?php

class User
{
    use Model;

    protected $table = 'users';

    protected $allowedColumns = ['email', 'password'];

    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['email'])) {
            $this->errors['email'] = "Email is required";
        } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Invalid email address";
        }

        if (empty($data['password'])) {
            $this->errors['password'] = "Password is required";
        }

        if (empty($this->errors)) {
            return true;
        }
        return false;
    }
}

<?php

namespace BVZ\Register;

class RegisterDTO
{
    private function __construct(
        public readonly string $email,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $address1,
        public readonly string $address2,
        public readonly string $message,
        public readonly array $errors = []
    )
    {}

    public static function create(
        string $email,
        string $firstName,
        string $lastName,
        string $address1,
        string $address2,
        string $message=""
    )
    {
        return new RegisterDTO($email, $firstName, $lastName, $address1, $address2, $message);
    }

    public static function error(array $errors)
    {
        return new RegisterDTO("", "", "", "", "", "", $errors);
    }
}

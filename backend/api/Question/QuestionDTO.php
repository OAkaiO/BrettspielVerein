<?php

namespace BVZ\Question;

class QuestionDTO
{
    private function __construct(
        public readonly string $email,
        public readonly string $fullName,
        public readonly string $message,
        public readonly array $errors = []
    )
    {}

    public static function create(string $email, string $fullName, string $message)
    {
        return new QuestionDTO($email, $fullName, $message);
    }

    public static function error(array $errors)
    {
        return new QuestionDTO("", "", "", $errors);
    }
}

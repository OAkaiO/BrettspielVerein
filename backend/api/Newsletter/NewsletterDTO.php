<?php

namespace BVZ\Newsletter;

class NewsletterDTO
{
    private function __construct(
        public readonly string $email,
        public readonly array $errors = []
    )
    {}

    public static function create(string $email)
    {
        return new NewsletterDTO($email);
    }

    public static function error(array $errors)
    {
        return new NewsletterDTO("", $errors);
    }
}

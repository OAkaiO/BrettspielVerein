<?php

namespace BVZ\Newsletter;

use BVZ\FieldValidator;

require_once __DIR__ . "/../../vendor/autoload.php";

class NewsletterParser
{
    public function __construct(private readonly FieldValidator $validator = new FieldValidator())
    {}

    /**
     * Extracts the passed email from a valid JSON Object and returns it.
     *
     * @param object $body The JSON object that should contain an email
     *
     * @return NewsletterDTO Returns the extracted valid email
     */
    public function parse(object $body) : NewsletterDTO
    {
        $emailValidation = $this->validator->validateEmailField($body, 'email');

        if ($emailValidation->isValid)
        {
            return NewsletterDTO::create($body->{'email'});
        }
        else 
        {
            return NewsletterDTO::error([$emailValidation->message]);
        }
    }
}


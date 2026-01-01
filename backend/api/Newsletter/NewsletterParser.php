<?php

namespace BVZ\Newsletter;

use BVZ\ParserException;

class NewsletterParser
{
    /**
     * Extracts the passed email from a valid JSON Object and returns it.
     *
     * @param string $body The JSON object that should contain an email
     * @throws NewsletterParserException when the body is invalid or does
     *                                   not contain a (valid) email
     *
     * @return string Returns the extracted valid email
     */
    public function parse(string $body) : string
    {
        $parsed = json_decode($body);
        if ($parsed === null)
        {
            throw new ParserException("Body not valid JSON!");
        }

        if (!property_exists($parsed, 'email')) {
            throw new ParserException("Email address not found!");
        }
        $emailAddr = $parsed->{'email'};
        if (filter_var($emailAddr, FILTER_VALIDATE_EMAIL) === false)
        {
            throw new ParserException("Email address not valid!");
        }
        else
        {
            return $emailAddr;
        }
    }
}


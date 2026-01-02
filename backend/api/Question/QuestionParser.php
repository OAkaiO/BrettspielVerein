<?php

namespace BVZ\Question;

use BVZ\FieldValidator;

require_once __DIR__ . "/../../vendor/autoload.php";

class QuestionParser
{
    public function __construct(private readonly FieldValidator $validator = new FieldValidator())
    {}

    /**
     * Extracts the passed email, name and question from a valid 
     * JSON Object and returns it.
     *
     * @param object $body The JSON object that should contain an email
     *
     * @return QuestionDTO Returns the extracted data
     */
    public function parse(object $body) : QuestionDTO
    {
        $errors = array();

        $emailValidation = $this->validator->validateEmailField($body, 'email');
        $nameValidation = $this->validator->validateNonEmptyStringField($body, 'fullName');
        $messageValidation = $this->validator->validateNonEmptyStringField($body, 'message');

        foreach (array($emailValidation, $nameValidation, $messageValidation) as $validation)
        {
            if (!$validation->isValid)
            {
                array_push($errors, $validation->message);
            }
        }
        if (!empty($errors))
        {
            return QuestionDTO::error($errors);
        }
        return QuestionDTO::create($body->{'email'}, $body->{'fullName'}, $body->{'message'});
    }
}

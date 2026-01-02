<?php

namespace BVZ\Member;

use BVZ\FieldValidator;

require_once __DIR__ . "/../../vendor/autoload.php";

class MemberParser
{
    public function __construct(private readonly FieldValidator $validator = new FieldValidator())
    {}

    /**
     * Extracts the passed email, name and question from a valid 
     * JSON Object and returns it.
     *
     * @param object $body The JSON object that should contain an email
     *
     * @return MemberDTO Returns the extracted data
     */
    public function parse(object $body) : MemberDTO
    {
        $errors = array();

        $emailValidation = $this->validator->validateEmailField($body, 'email');
        $firstNameValidation = $this->validator->validateNonEmptyStringField($body, 'firstName');
        $lastNameValidation = $this->validator->validateNonEmptyStringField($body, 'lastName');
        $address1Validation = $this->validator->validateNonEmptyStringField($body, 'address1');
        $address2Validation = $this->validator->validateNonEmptyStringField($body, 'address2');

        foreach (array($emailValidation, $firstNameValidation, $lastNameValidation, $address1Validation, $address2Validation) as $validation)
        {
            if (!$validation->isValid)
            {
                array_push($errors, $validation->message);
            }
        }
        if (!empty($errors))
        {
            return MemberDTO::error($errors);
        }
        return MemberDTO::create($body->{'email'}, $body->{'firstName'}, $body->{'lastName'}, $body->{'address1'}, $body->{'address2'}, $body->{'message'} ?? "");
    }
}

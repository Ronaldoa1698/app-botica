<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class ProductFormData extends Constraint
{
    public string $message = 'The field "{{ field }}" is required.';
}

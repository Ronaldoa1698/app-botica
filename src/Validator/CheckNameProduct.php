<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraints\Compound;
use Symfony\Component\Validator\Constraints as Assert;

class CheckNameProduct extends Compound
{

    protected function getConstraints(array $options): array
    {
        return [
            new Assert\NotBlank([
                'message' => 'Name is required',
            ]),
        ];
    }
}
<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use App\Entity\Product;

class ProductFormDataValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (!$value instanceof Product) {
            return;
        }

        // Ahora puedes acceder a las propiedades del objeto Product.
        if (empty($value->getName()) && empty($value->getCode()) && $value->getPrice() === null) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
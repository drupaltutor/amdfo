<?php

namespace Drupal\zoopal_creature\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Validates the Alliterative String constraint.
 */
class AlliterativeStringConstraintValidator extends ConstraintValidator {

  /**
   * {@inheritdoc}
   */
  public function validate($items, Constraint $constraint) {

    foreach ($items as $delta => $item) {
      $parts = explode(' the ', $item->value);
      if (
        count($parts) < 2
        || mb_strtolower(substr($parts[0], 0, 1)) !== mb_strtolower(substr($parts[1], 0, 1))
      ) {
        $this->context->buildViolation($constraint->errorMessage)
          ->atPath($delta)
          ->addViolation();
      }
    }

  }

}

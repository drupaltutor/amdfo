<?php

namespace Drupal\zoopal_habitat\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Validates the Sufficient Description Length constraint.
 */
class SufficientDescriptionLengthConstraintValidator extends ConstraintValidator {

  /**
   * {@inheritdoc}
   */
  public function validate($items, Constraint $constraint) {

    foreach ($items as $delta => $item) {
      // @DCG Validate the item here.
      if (mb_strlen(strip_tags($item->value)) < $constraint->min_chars) {
        $this->context->buildViolation($constraint->errorMessage)
          ->atPath($delta)
          ->addViolation();
      }
    }

  }

}

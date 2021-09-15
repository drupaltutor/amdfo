<?php

namespace Drupal\zoopal_creature\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Validates the Author and Creature Name Alliteration constraint.
 */
class AuthorAndCreatureNameAlliterationConstraintValidator extends ConstraintValidator {

  /**
   * {@inheritdoc}
   */
  public function validate($entity, Constraint $constraint) {

    $author_first_letter = mb_strtolower(substr($entity->get('uid')->entity->label(), 0, 1));
    $creature_first_letter = mb_strtolower(substr($entity->label(), 0, 1));
    if ($creature_first_letter !== $author_first_letter) {
      $this->context->buildViolation($constraint->errorMessage)
        ->atPath('name')
        ->atPath('uid')
        ->addViolation();
    }

  }

}

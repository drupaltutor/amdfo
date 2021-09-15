<?php

namespace Drupal\zoopal_creature\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Provides an Author and Creature Name Alliteration constraint.
 *
 * @Constraint(
 *   id = "ZoopalCreatureAuthorAndCreatureNameAlliteration",
 *   label = @Translation("Author and Creature Name Alliteration", context = "Validation"),
 * )
 *
 * @DCG
 * To apply this constraint on a particular field implement
 * hook_entity_type_build().
 */
class AuthorAndCreatureNameAlliterationConstraint extends Constraint {

  public $errorMessage = 'You can only save creatures who have the same first letter of their name as the author.';

}

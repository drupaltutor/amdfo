<?php

namespace Drupal\zoopal_creature\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Provides an Alliterative String constraint.
 *
 * @Constraint(
 *   id = "ZoopalCreatureAlliterativeString",
 *   label = @Translation("Alliterative String", context = "Validation"),
 * )
 *
 * @DCG
 * To apply this constraint on third party entity types implement either
 * hook_entity_base_field_info_alter() or hook_entity_bundle_field_info_alter().
 */
class AlliterativeStringConstraint extends Constraint {

  public $errorMessage = 'This string should be alliterative, like "Zed the Zebra".';

}

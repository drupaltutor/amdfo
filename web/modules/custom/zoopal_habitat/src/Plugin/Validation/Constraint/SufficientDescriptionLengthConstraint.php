<?php

namespace Drupal\zoopal_habitat\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Provides a Sufficient Description Length constraint.
 *
 * @Constraint(
 *   id = "ZoopalHabitatSufficientDescriptionLength",
 *   label = @Translation("Sufficient Description Length", context = "Validation"),
 * )
 *
 * @DCG
 * To apply this constraint on third party entity types implement either
 * hook_entity_base_field_info_alter() or hook_entity_bundle_field_info_alter().
 */
class SufficientDescriptionLengthConstraint extends Constraint {

  public $errorMessage = 'This field is not long enough. Add more characters.';

}

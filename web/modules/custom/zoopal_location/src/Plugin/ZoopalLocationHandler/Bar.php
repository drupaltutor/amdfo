<?php

namespace Drupal\zoopal_location\Plugin\ZoopalLocationHandler;

use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\zoopal_location\ZoopalLocationHandlerPluginBase;

/**
 * Plugin implementation of the zoopal_location_handler.
 *
 * @ZoopalLocationHandler(
 *   id = "bar",
 *   label = @Translation("Bar")
 * )
 */
class Bar extends ZoopalLocationHandlerPluginBase {

  use StringTranslationTrait;

  public function render(FieldItemInterface $item) {
    return [
      '#markup' => $this->t('@creature_name: bar', [
        '@creature_name' => $item->getEntity()->label(),
      ]),
    ];
  }

}

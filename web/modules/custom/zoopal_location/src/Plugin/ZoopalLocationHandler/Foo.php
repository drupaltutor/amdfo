<?php

namespace Drupal\zoopal_location\Plugin\ZoopalLocationHandler;

use Drupal\Core\Field\FieldItemInterface;
use Drupal\zoopal_location\ZoopalLocationHandlerPluginBase;

/**
 * Plugin implementation of the zoopal_location_handler.
 *
 * @ZoopalLocationHandler(
 *   id = "foo",
 *   label = @Translation("Foo")
 * )
 */
class Foo extends ZoopalLocationHandlerPluginBase {

  public function render(FieldItemInterface $item) {
    return [
      '#markup' => 'foo',
    ];
  }

}

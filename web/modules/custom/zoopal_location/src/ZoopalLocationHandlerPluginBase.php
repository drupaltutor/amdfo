<?php

namespace Drupal\zoopal_location;

use Drupal\Component\Plugin\PluginBase;

/**
 * Base class for zoopal_location_handler plugins.
 */
abstract class ZoopalLocationHandlerPluginBase extends PluginBase implements ZoopalLocationHandlerInterface {

  /**
   * {@inheritdoc}
   */
  public function label() {
    // Cast the label to a string since it is a TranslatableMarkup object.
    return (string) $this->pluginDefinition['label'];
  }

}

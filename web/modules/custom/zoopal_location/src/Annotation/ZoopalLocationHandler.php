<?php

namespace Drupal\zoopal_location\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines zoopal_location_handler annotation object.
 *
 * @Annotation
 */
class ZoopalLocationHandler extends Plugin {

  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The human-readable name of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $label;

}

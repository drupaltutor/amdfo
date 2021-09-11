<?php

namespace Drupal\zoopal_location;

/**
 * Interface for zoopal_location_handler plugins.
 */
interface ZoopalLocationHandlerInterface {

  /**
   * Returns the translated plugin label.
   *
   * @return string
   *   The translated title.
   */
  public function label();

}

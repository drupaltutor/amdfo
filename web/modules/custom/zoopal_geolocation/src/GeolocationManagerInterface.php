<?php

namespace Drupal\zoopal_geolocation;

/**
 * GeolocationManagerInterface service interface.
 */
interface GeolocationManagerInterface {

  /**
   * @return array
   */
  public function getPosition(string $geolocation_id);

  /**
   * @param string $geolocation_id
   * @return bool
   */
  public function hasEscaped(string $geolocation_id);
  
}

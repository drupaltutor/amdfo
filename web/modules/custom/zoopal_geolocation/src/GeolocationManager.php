<?php

namespace Drupal\zoopal_geolocation;

use GuzzleHttp\ClientInterface;

/**
 * GeolocationManager service.
 */
class GeolocationManager {

  /**
   * The HTTP client.
   *
   * @var \GuzzleHttp\ClientInterface
   */
  protected $httpClient;

  /**
   * Constructs a GeolocationManager object.
   *
   * @param \GuzzleHttp\ClientInterface $http_client
   *   The HTTP client.
   */
  public function __construct(ClientInterface $http_client) {
    $this->httpClient = $http_client;
  }

  public function getPosition(string $geolocation_id)
  {
    return [
      'lat' => 5.525 + (rand(-100, 100) * 0.0002),
      'long' => -87.069 + (rand(-100, 100) * 0.0002),
    ];
  }


}

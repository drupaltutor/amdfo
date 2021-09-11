<?php

namespace Drupal\zoopal_geolocation;

use GuzzleHttp\ClientInterface;

/**
 * GeolocationManager service.
 */
class GeolocationManager implements GeolocationManagerInterface {

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
    $escape = rand(1, 4) === 2;
    if ($escape) {
      return [
        'lat' => 5.525 + (rand(-100, 100) * 0.0008),
        'long' => -87.069 + (rand(-100, 100) * 0.0008),
      ];
    }

    return [
      'lat' => 5.525 + (rand(-100, 100) * 0.0002),
      'long' => -87.069 + (rand(-100, 100) * 0.0002),
    ];
  }

  public function hasEscaped(string $geolocation_id) {
    $position = $this->getPosition($geolocation_id);
    return $position['lat'] > 5.545
      || $position['lat'] < 5.505
      || $position['long'] > -87.049
      || $position['long'] < -87.089;
  }


}

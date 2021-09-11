<?php

namespace Drupal\zoopal_geolocation\Plugin\ZoopalLocationHandler;

use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\zoopal_geolocation\GeolocationManager;
use Drupal\zoopal_location\ZoopalLocationHandlerPluginBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Plugin implementation of the zoopal_location.
 *
 * @ZoopalLocationHandler(
 *   id = "zoopal_geolocation",
 *   label = @Translation("Geolocation"),
 * )
 */
class GeoLocationHandler extends ZoopalLocationHandlerPluginBase implements ContainerFactoryPluginInterface
{

  /**
   * @var GeolocationManager
   */
  protected $geolocationManager;

  protected function setGeolocationManager(GeolocationManager $geolocationManager)
  {
    $this->geolocationManager = $geolocationManager;
  }

  /**
   * Creates an instance of the plugin.
   *
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *   The container to pull out services used in the plugin.
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin ID for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   *
   * @return static
   *   Returns an instance of this plugin.
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition)
  {
    $instance = new static($configuration, $plugin_id, $plugin_id);
    $instance->setGeolocationManager($container->get('zoopal_geolocation.manager'));
    return $instance;
  }


  public function render(FieldItemInterface $item)
  {
    $build = [];
    $geolocation_id = $item->getEntity()->get('zoopal_geolocation_id')->value;
    $cache = new CacheableMetadata();
    $cache->setCacheMaxAge(3);
    if (!empty($geolocation_id)) {
      $location = $this->geolocationManager->getPosition($geolocation_id);
      $build = [
        '#type' => 'html_tag',
        '#tag' => 'iframe',
        '#attributes' => [
          'width' => 700,
          'height' => 500,
          'frameborder' => 0,
          'scrolling' => 'no',
          'marginheight' => 0,
          'marginwidth' => 0,
          'src' => 'https://maps.google.com/maps?q=' . $location['lat'] . ',' . $location['long'] . '&z=13&output=embed',
        ],
      ];
    }
    $cache->applyTo($build);
    return $build;
  }

  public function creatureFormAlter(array &$form, FormStateInterface $form_state)
  {
    $form['zoopal_geolocation_id']['widget'][0]['value']['#states'] = [
      'visible' => [
        ':input[name="zoopal_location_handler"]' => ['value' => 'zoopal_geolocation'],
      ],
      'required' => [
        ':input[name="zoopal_location_handler"]' => ['value' => 'zoopal_geolocation'],
      ],
    ];
  }
}

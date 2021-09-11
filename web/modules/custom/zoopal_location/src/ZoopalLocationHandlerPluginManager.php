<?php

namespace Drupal\zoopal_location;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;

/**
 * ZoopalLocationHandler plugin manager.
 */
class ZoopalLocationHandlerPluginManager extends DefaultPluginManager {

  /**
   * Constructs ZoopalLocationHandlerPluginManager object.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct(
      'Plugin/ZoopalLocationHandler',
      $namespaces,
      $module_handler,
      'Drupal\zoopal_location\ZoopalLocationHandlerInterface',
      'Drupal\zoopal_location\Annotation\ZoopalLocationHandler'
    );
    $this->alterInfo('zoopal_location_handler_info');
    $this->setCacheBackend($cache_backend, 'zoopal_location_handler_plugins');
  }

}

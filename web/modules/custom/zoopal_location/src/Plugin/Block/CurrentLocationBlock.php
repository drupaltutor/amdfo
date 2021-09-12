<?php

namespace Drupal\zoopal_location\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\example\ExampleInterface;
use Drupal\zoopal_location\ZoopalLocationHandlerPluginManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a where am i? block.
 *
 * @Block(
 *   id = "zoopal_location_current",
 *   admin_label = @Translation("Where am I?"),
 *   category = @Translation("ZooPal")
 * )
 */
class CurrentLocationBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The plugin.manager.zoopal_location_handler service.
   *
   * @var ZoopalLocationHandlerPluginManager
   */
  protected $pluginManagerZoopalLocationHandler;

  /**
   * The current route match.
   *
   * @var \Drupal\Core\Routing\RouteMatchInterface
   */
  protected $routeMatch;

  /**
   * Constructs a new CurrentLocationBlock instance.
   *
   * @param array $configuration
   *   The plugin configuration, i.e. an array with configuration values keyed
   *   by configuration option name. The special key 'context' may be used to
   *   initialize the defined contexts by setting it to an array of context
   *   values keyed by context names.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param ZoopalLocationHandlerPluginManager $plugin_manager_zoopal_location_handler
   *   The plugin.manager.zoopal_location_handler service.
   * @param \Drupal\Core\Routing\RouteMatchInterface $route_match
   *   The current route match.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, ZoopalLocationHandlerPluginManager $plugin_manager_zoopal_location_handler, RouteMatchInterface $route_match) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->pluginManagerZoopalLocationHandler = $plugin_manager_zoopal_location_handler;
    $this->routeMatch = $route_match;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('plugin.manager.zoopal_location_handler'),
      $container->get('current_route_match')
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function blockAccess(AccountInterface $account)
  {
    $route_name = $this->routeMatch->getRouteName();
    if ($route_name === 'entity.zoopal_creature.canonical') {
      $creature = $this->routeMatch->getParameter('zoopal_creature');
      return AccessResult::allowedIf(
        $creature->hasField('zoopal_location_handler')
        && !$creature->get('zoopal_location_handler')->isEmpty()
      );
    }
    return AccessResult::forbidden();
  }


  /**
   * {@inheritdoc}
   */
  public function build()
  {
    $build = [];

    $creature = $this->routeMatch->getParameter('zoopal_creature');
    
    $cache = new CacheableMetadata();
    $cache->addCacheContexts(['route']);
    $cache->addCacheableDependency($creature);

    $items = $creature->get('zoopal_location_handler');
    foreach ($items as $delta => $item) {
      if (!empty($item->value)) {
        $plugin = $this->pluginManagerZoopalLocationHandler->createInstance($item->value);
        $build[$delta] = $plugin->render($item);
      }
    }
    $cache->applyTo($build);
    return $build;
  }


}

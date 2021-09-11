<?php

namespace Drupal\zoopal_habitat\Plugin\ZoopalLocationHandler;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\zoopal_location\ZoopalLocationHandlerPluginBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Plugin implementation of the zoopal_location.
 *
 * @ZoopalLocationHandler(
 *   id = "zoopal_habitat",
 *   label = @Translation("Habitat"),
 * )
 */
class HabitatLocationHandler extends ZoopalLocationHandlerPluginBase implements ContainerFactoryPluginInterface
{

  /**
   * @var EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  protected function setEntityTypeManager(EntityTypeManagerInterface $entityTypeManager) {
    $this->entityTypeManager = $entityTypeManager;
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
    $instance->setEntityTypeManager($container->get('entity_type.manager'));
    return $instance;
  }


  public function render(FieldItemInterface $item) {
    $habitat = $item->getEntity()->get('zoopal_habitat')->entity;
    if (!empty($habitat)) {
      $view = $this->entityTypeManager->getViewBuilder('zoopal_habitat')->view($habitat);
      return $view;
    }
    return [];
  }

  public function creatureFormAlter(array &$form, FormStateInterface $form_state)
  {
    $form['zoopal_habitat']['widget'][0]['target_id']['#states'] = [
      'visible' => [
        ':input[name="zoopal_location_handler"]' => ['value' => 'zoopal_habitat'],
      ],
      'required' => [
        ':input[name="zoopal_location_handler"]' => ['value' => 'zoopal_habitat'],
      ],
    ];
  }

}

<?php

namespace Drupal\zoopal_location;

use Drupal\Component\Plugin\PluginBase;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Form\FormStateInterface;

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

  /**
   * Render the location
   *
   * @param FieldItemInterface $item
   * return array
   */
  abstract public function render(FieldItemInterface $item);

  /**
   * @param array $form
   * @param FormStateInterface $form_state
   * @return void
   */
  public function creatureFormAlter(array &$form, FormStateInterface $form_state) {
  }


}

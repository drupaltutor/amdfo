<?php

namespace Drupal\zoopal_location;

use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Form\FormStateInterface;

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

  /**
   * Render the location
   *
   * @param FieldItemInterface $item
   * return array
   */
  public function render(FieldItemInterface $item);

  /**
   * @param array $form
   * @param FormStateInterface $form_state
   * @return void
   */
  public function creatureFormAlter(array &$form, FormStateInterface $form_state);
}

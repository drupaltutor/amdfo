<?php

namespace Drupal\zoopal_habitat;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a habitat entity type.
 */
interface ZoopalHabitatInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

  /**
   * Gets the habitat title.
   *
   * @return string
   *   Title of the habitat.
   */
  public function getTitle();

  /**
   * Sets the habitat title.
   *
   * @param string $title
   *   The habitat title.
   *
   * @return \Drupal\zoopal_habitat\ZoopalHabitatInterface
   *   The called habitat entity.
   */
  public function setTitle($title);

  /**
   * Gets the habitat creation timestamp.
   *
   * @return int
   *   Creation timestamp of the habitat.
   */
  public function getCreatedTime();

  /**
   * Sets the habitat creation timestamp.
   *
   * @param int $timestamp
   *   The habitat creation timestamp.
   *
   * @return \Drupal\zoopal_habitat\ZoopalHabitatInterface
   *   The called habitat entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the habitat status.
   *
   * @return bool
   *   TRUE if the habitat is enabled, FALSE otherwise.
   */
  public function isEnabled();

  /**
   * Sets the habitat status.
   *
   * @param bool $status
   *   TRUE to enable this habitat, FALSE to disable.
   *
   * @return \Drupal\zoopal_habitat\ZoopalHabitatInterface
   *   The called habitat entity.
   */
  public function setStatus($status);

}

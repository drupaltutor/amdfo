<?php

namespace Drupal\zoopal_creature;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a creature entity type.
 */
interface ZoopalCreatureInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

  /**
   * Gets the creature title.
   *
   * @return string
   *   Title of the creature.
   */
  public function getName();

  /**
   * Sets the creature title.
   *
   * @param string $title
   *   The creature title.
   *
   * @return \Drupal\zoopal_creature\ZoopalCreatureInterface
   *   The called creature entity.
   */
  public function setName($name);

  /**
   * Gets the creature creation timestamp.
   *
   * @return int
   *   Creation timestamp of the creature.
   */
  public function getCreatedTime();

  /**
   * Sets the creature creation timestamp.
   *
   * @param int $timestamp
   *   The creature creation timestamp.
   *
   * @return \Drupal\zoopal_creature\ZoopalCreatureInterface
   *   The called creature entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the creature status.
   *
   * @return bool
   *   TRUE if the creature is enabled, FALSE otherwise.
   */
  public function isEnabled();

  /**
   * Sets the creature status.
   *
   * @param bool $status
   *   TRUE to enable this creature, FALSE to disable.
   *
   * @return \Drupal\zoopal_creature\ZoopalCreatureInterface
   *   The called creature entity.
   */
  public function setStatus($status);

}

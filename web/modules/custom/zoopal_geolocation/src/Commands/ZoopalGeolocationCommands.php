<?php

namespace Drupal\zoopal_geolocation\Commands;

use Consolidation\OutputFormatters\StructuredData\RowsOfFields;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\zoopal_geolocation\GeolocationManagerInterface;
use Drush\Commands\DrushCommands;

/**
 * A Drush commandfile.
 *
 * In addition to this file, you need a drush.services.yml
 * in root of your module, and a composer.json file that provides the name
 * of the services file to use.
 *
 * See these files for an example of injecting Drupal services:
 *   - http://cgit.drupalcode.org/devel/tree/src/Commands/DevelCommands.php
 *   - http://cgit.drupalcode.org/devel/tree/drush.services.yml
 */
class ZoopalGeolocationCommands extends DrushCommands {

  /**
   * @var EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * @var GeolocationManagerInterface
   */
  protected $geolocationManager;

  public function __construct(EntityTypeManagerInterface $entityTypeManager, GeolocationManagerInterface $geolocationManager)
  {
    $this->entityTypeManager = $entityTypeManager;
    $this->geolocationManager = $geolocationManager;
  }

  /**
   * Unpublishes creatures that have escaped
   *
   * @command zoopal:unpublish_escaped
   * @aliases yikes
   */
  public function unpublishEscapedCreatures() {
    $creature_storage = $this->entityTypeManager->getStorage('zoopal_creature');
    $results = $creature_storage->getQuery()
      ->condition('status', TRUE)
      ->condition('zoopal_location_handler', 'zoopal_geolocation')
      ->execute();
    foreach ($results as $creature_id) {
      $creature = $creature_storage->load($creature_id);
      $this->writeln($creature->label() . ': ' . $creature->get('zoopal_geolocation_id')->value);
    }
  }

}

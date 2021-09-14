<?php

namespace Drupal\zoopal_geolocation\Commands;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\zoopal_alerts\Event\AlertEvents;
use Drupal\zoopal_alerts\Event\CreatureAlertEvent;
use Drupal\zoopal_geolocation\GeolocationManagerInterface;
use Drush\Commands\DrushCommands;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

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

  /**
   * @var EventDispatcherInterface
   */
  protected $eventDispatcher;

  public function __construct(EntityTypeManagerInterface $entityTypeManager, GeolocationManagerInterface $geolocationManager, EventDispatcherInterface $eventDispatcher) {
    $this->entityTypeManager = $entityTypeManager;
    $this->geolocationManager = $geolocationManager;
    $this->eventDispatcher = $eventDispatcher;
  }

  /**
   * Unpublishes creatures that have escaped
   *
   * @command zoopal:check_escaped
   * @aliases yikes
   */
  public function checkEscapedCreatures() {
    $creature_storage = $this->entityTypeManager->getStorage('zoopal_creature');
    $results = $creature_storage->getQuery()
      ->condition('status', TRUE)
      ->condition('zoopal_location_handler', 'zoopal_geolocation')
      ->execute();
    foreach ($results as $creature_id) {
      $creature = $creature_storage->load($creature_id);

      $geolocation_id = $creature->get('zoopal_geolocation_id')->value;
      if ($this->geolocationManager->hasEscaped($geolocation_id)) {
        $this->eventDispatcher->dispatch(new CreatureAlertEvent($creature), AlertEvents::CREATURE_ESCAPED);
        $this->writeln(t('@label has escaped.', [
          '@label' => $creature->label(),
        ]));
      }

    }
  }

}

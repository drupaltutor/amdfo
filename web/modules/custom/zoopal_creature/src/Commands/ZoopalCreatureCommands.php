<?php

namespace Drupal\zoopal_creature\Commands;

use Consolidation\OutputFormatters\StructuredData\RowsOfFields;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
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
class ZoopalCreatureCommands extends DrushCommands {

  /**
   * @var EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  public function __construct(EntityTypeManagerInterface $entityTypeManager) {
    $this->entityTypeManager = $entityTypeManager;
  }

  /**
   * Prints out a report of all creatures and their statuses

   * @command zoopal:creature_report
   * @aliases creature-report
   *
   * @return \Consolidation\OutputFormatters\StructuredData\RowsOfFields
   */
  public function creatureReport() {
    $rows = [];

    $creature_storage = $this->entityTypeManager->getStorage('zoopal_creature');
    $results = $creature_storage->getQuery()
      ->execute();
    foreach ($results as $creature_id) {
      $creature = $creature_storage->load($creature_id);
      $rows[] = [
        'Name' => $creature->label(),
        'Enabled' => $creature->isEnabled(),
      ];
    }
    return new RowsOfFields($rows);
  }

}

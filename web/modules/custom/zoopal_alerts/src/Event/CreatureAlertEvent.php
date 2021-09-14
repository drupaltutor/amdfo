<?php

namespace Drupal\zoopal_alerts\Event;

use Drupal\Component\EventDispatcher\Event;
use Drupal\zoopal_creature\ZoopalCreatureInterface;

class CreatureAlertEvent extends Event {

  /**
   * @var ZoopalCreatureInterface
   */
  protected $creature;


  public function __construct(ZoopalCreatureInterface $creature)
  {
    $this->creature = $creature;
  }

  /**
   * @return ZoopalCreatureInterface
   */
  public function getCreature()
  {
    return $this->creature;
  }
}

<?php

namespace Drupal\zoopal_geolocation\EventSubscriber;

use Drupal\Core\Messenger\MessengerInterface;
use Drupal\zoopal_alerts\Event\AlertEvents;
use Drupal\zoopal_alerts\Event\CreatureAlertEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * ZooPal Geolocation event subscriber.
 */
class ZoopalGeolocationSubscriber implements EventSubscriberInterface {

  public function onCreatureEscape(CreatureAlertEvent $event) {
    $event->getCreature()->set('status', FALSE)
      ->save();
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return [
      AlertEvents::CREATURE_ESCAPED => ['onCreatureEscape'],
    ];
  }

}

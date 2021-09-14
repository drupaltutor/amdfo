<?php

namespace Drupal\zoopal_alerts\EventSubscriber;

use Drupal\Core\Mail\MailManagerInterface;
use Drupal\zoopal_alerts\Event\AlertEvents;
use Drupal\zoopal_alerts\Event\CreatureAlertEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * ZooPal Alerts event subscriber.
 */
class ZoopalAlertsSubscriber implements EventSubscriberInterface {

  /**
   * @var MailManagerInterface
   */
  protected $mailManager;

  /**
   * Constructs event subscriber.
   *
   * @param MailManagerInterface $mail_manager
   */
  public function __construct(MailManagerInterface $mail_manager) {
    $this->mailManager = $mail_manager;
  }

  public function onCreatureEscape(CreatureAlertEvent $event) {
    $params = [
      'creature' => $event->getCreature(),
    ];
    $this->mailManager->mail('zoopal_alerts', 'creature_escaped', 'zookeeper@example.com', 'en', $params);
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

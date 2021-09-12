<?php

namespace Drupal\zoopal_core\EventSubscriber;

use Drupal\Core\Config\ConfigCrudEvent;
use Drupal\Core\Config\ConfigEvents;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * ZooPal Core event subscriber.
 */
class ConfigEventSubscriber implements EventSubscriberInterface {

  use StringTranslationTrait;

  /**
   * The messenger.
   *
   * @var \Drupal\Core\Messenger\MessengerInterface
   */
  protected $messenger;

  /**
   * Constructs event subscriber.
   *
   * @param \Drupal\Core\Messenger\MessengerInterface $messenger
   *   The messenger.
   */
  public function __construct(MessengerInterface $messenger) {
    $this->messenger = $messenger;
  }

  public function configUpdated(ConfigCrudEvent $event) {
    $this->messenger->addWarning($this->t('You have updated the website configuration setting: @name.
      Be sure to capture this update with a config export.', [
      '@name' => $event->getConfig()->getName(),
    ]));
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return [
      ConfigEvents::SAVE => ['configUpdated'],
      ConfigEvents::DELETE => ['configUpdated'],
    ];
  }

}

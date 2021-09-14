<?php

namespace Drupal\zoopal_core;

use Drupal\Core\Messenger\MessengerInterface;

class BackwardsMessengerDecorator implements MessengerInterface {

  /**
   * @var MessengerInterface
   */
  protected $originalMessenger;

  public function __construct(MessengerInterface $orignalMessenger) {
    $this->originalMessenger = $orignalMessenger;
  }

  public function addMessage($message, $type = self::TYPE_STATUS, $repeat = FALSE) {
    return $this->originalMessenger->addMessage($this->reverseMessage($message), $type, $repeat);
  }

  protected function reverseMessage($message) {
    $words = preg_split('/\s/', $message);
    $words = array_reverse($words);
    return implode(' ', $words);
  }


  public function addStatus($message, $repeat = FALSE) {
    return $this->originalMessenger->addStatus($this->reverseMessage($message), $repeat);
  }


  public function addError($message, $repeat = FALSE) {
    return $this->originalMessenger->addError($this->reverseMessage($message), $repeat);
  }

  public function addWarning($message, $repeat = FALSE) {
    return $this->originalMessenger->addWarning($this->reverseMessage($message), $repeat);
  }

  public function all() {
    return $this->originalMessenger->all();
  }


  public function messagesByType($type) {
    return $this->originalMessenger->messagesByType($type);
  }

  public function deleteAll() {
    return $this->originalMessenger->deleteAll();
  }

  public function deleteByType($type) {
    return $this->originalMessenger->deleteByType($type);
  }

}

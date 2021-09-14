<?php

namespace Drupal\zoopal_core;

use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\Messenger\Messenger;

class BackwardsMessenger extends Messenger implements MessengerInterface {

  public function addMessage($message, $type = self::TYPE_STATUS, $repeat = FALSE) {
    $words = preg_split('/\s/', $message);
    $words = array_reverse($words);
    return parent::addMessage(implode(' ', $words), $type, $repeat);
  }

}

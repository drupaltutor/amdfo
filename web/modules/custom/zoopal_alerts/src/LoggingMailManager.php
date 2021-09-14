<?php

namespace Drupal\zoopal_alerts;

use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Drupal\Core\Mail\MailManagerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;
use Psr\Log\LoggerInterface;

class LoggingMailManager extends DefaultPluginManager implements MailManagerInterface {

  /**
   * @var MailManagerInterface
   */
  protected $originalMailManager;

  /**
   * @var LoggerInterface
   */
  protected $logger;

  public function __construct(MailManagerInterface $original_mail_manager, LoggerChannelFactoryInterface $logger_factory)
  {
    $this->originalMailManager = $original_mail_manager;
    $this->logger = $logger_factory->get('zoopal_alerts');
  }

  public function mail($module, $key, $to, $langcode, $params = [], $reply = NULL, $send = TRUE) {
    $this->logger->info('Sent email with module:key @module:@key to @recipient', [
      '@module' => $module,
      '@key' => $key,
      '@recipient' => $to,
    ]);
    return $this->originalMailManager->mail($module, $key, $to, $langcode, $params, $reply, $send);
  }

}

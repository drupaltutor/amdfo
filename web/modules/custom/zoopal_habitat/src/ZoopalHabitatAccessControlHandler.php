<?php

namespace Drupal\zoopal_habitat;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Defines the access control handler for the habitat entity type.
 */
class ZoopalHabitatAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {

    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view habitat');

      case 'update':
        return AccessResult::allowedIfHasPermissions($account, ['edit habitat', 'administer habitat'], 'OR');

      case 'delete':
        return AccessResult::allowedIfHasPermissions($account, ['delete habitat', 'administer habitat'], 'OR');

      default:
        // No opinion.
        return AccessResult::neutral();
    }

  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermissions($account, ['create habitat', 'administer habitat'], 'OR');
  }

}

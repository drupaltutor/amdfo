<?php

namespace Drupal\zoopal_habitat\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the habitat entity edit forms.
 */
class ZoopalHabitatForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {

    $entity = $this->getEntity();
    $result = $entity->save();
    $link = $entity->toLink($this->t('View'))->toRenderable();

    $message_arguments = ['%label' => $this->entity->label()];
    $logger_arguments = $message_arguments + ['link' => render($link)];

    if ($result == SAVED_NEW) {
      $this->messenger()->addStatus($this->t('New habitat %label has been created.', $message_arguments));
      $this->logger('zoopal_habitat')->notice('Created new habitat %label', $logger_arguments);
    }
    else {
      $this->messenger()->addStatus($this->t('The habitat %label has been updated.', $message_arguments));
      $this->logger('zoopal_habitat')->notice('Updated new habitat %label.', $logger_arguments);
    }

    $form_state->setRedirect('entity.zoopal_habitat.canonical', ['zoopal_habitat' => $entity->id()]);
  }

}

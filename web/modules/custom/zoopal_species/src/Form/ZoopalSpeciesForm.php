<?php

namespace Drupal\zoopal_species\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Species form.
 *
 * @property \Drupal\zoopal_species\ZoopalSpeciesInterface $entity
 */
class ZoopalSpeciesForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form = parent::form($form, $form_state);

    $form['scientific_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Scientfic Name'),
      '#maxlength' => 255,
      '#default_value' => $this->entity->label(),
      '#description' => $this->t('Scientific name for the species.'),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $this->entity->id(),
      '#machine_name' => [
        'exists' => '\Drupal\zoopal_species\Entity\ZoopalSpecies::load',
        'source' => ['scientific_name'],
      ],
      '#disabled' => !$this->entity->isNew(),
    ];

    $form['status'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enabled'),
      '#default_value' => $this->entity->status(),
    ];

    $common_names = $this->entity->get('common_names');
    $form['common_names'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Common Names'),
      '#default_value' => ($common_names !== NULL) ? implode(', ', $common_names) : '',
      '#description' => $this->t('Common names of the species.'),
    ];

    $form['natural_habitat'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Natural Habitat'),
      '#default_value' => $this->entity->get('natural_habitat'),
      '#description' => $this->t('Natural habitat of the species.'),
    ];

    $form['description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Description'),
      '#default_value' => $this->entity->get('description'),
      '#description' => $this->t('Description of the species.'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $common_names = explode(',', $form_state->getValue('common_names'));
    $common_names = array_map('trim', $common_names);
    $this->entity->set('common_names', $common_names);

    $result = parent::save($form, $form_state);
    $message_args = ['%label' => $this->entity->label()];
    $message = $result == SAVED_NEW
      ? $this->t('Created new species %label.', $message_args)
      : $this->t('Updated species %label.', $message_args);
    $this->messenger()->addStatus($message);
    $form_state->setRedirectUrl($this->entity->toUrl('collection'));
    return $result;
  }

}

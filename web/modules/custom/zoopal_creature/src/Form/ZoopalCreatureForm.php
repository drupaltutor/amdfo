<?php

namespace Drupal\zoopal_creature\Form;

use Drupal\Component\Datetime\TimeInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Entity\EntityRepositoryInterface;
use Drupal\Core\Entity\EntityTypeBundleInfoInterface;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Form controller for the creature entity edit forms.
 */
class ZoopalCreatureForm extends ContentEntityForm {

  /**
   * @var \Drupal\Core\Config\ImmutableConfig
   */
  protected $config;


  /**
   * Constructs a ZoopalCreatureForm object.
   *
   * @param \Drupal\Core\Entity\EntityRepositoryInterface $entity_repository
   *   The entity repository service.
   * @param \Drupal\Core\Entity\EntityTypeBundleInfoInterface $entity_type_bundle_info
   *   The entity type bundle service.
   * @param \Drupal\Component\Datetime\TimeInterface $time
   *   The time service.
   * @param \Drupal\Core\Config\ConfigFactoryInterface
   *   The config factory service
   */
  public function __construct(EntityRepositoryInterface $entity_repository, EntityTypeBundleInfoInterface $entity_type_bundle_info, TimeInterface $time, ConfigFactoryInterface $configFactory) {
    $this->entityRepository = $entity_repository;
    $this->entityTypeBundleInfo = $entity_type_bundle_info;
    $this->time = $time;
    $this->config = $configFactory->get('zoopal_creature.settings');
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity.repository'),
      $container->get('entity_type.bundle.info'),
      $container->get('datetime.time'),
      $container->get('config.factory')
    );
  }

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
      $this->messenger()->addStatus($this->t('New creature %label has been created.', $message_arguments));
      $this->logger('zoopal_creature')->notice('Created new creature %label', $logger_arguments);
    }
    else {
      $this->messenger()->addStatus($this->t('The creature %label has been updated.', $message_arguments));
      $this->logger('zoopal_creature')->notice('Updated new creature %label.', $logger_arguments);
    }

    $form_state->setRedirect('entity.zoopal_creature.canonical', ['zoopal_creature' => $entity->id()]);
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $form['authoring_information'] = [
      '#type' => 'details',
      '#title' => $this->t('Authoring information'),
      '#open' => FALSE,
      '#group' => 'advanced',
      '#weight' => 10,
    ];

    $form['uid']['#group'] = 'authoring_information';
    $form['created']['#group'] = 'authoring_information';

    $form['revision']['#default_value'] = $this->config->get('revision_default');

    $form['publishing_information'] = [
      '#type' => 'details',
      '#title' => $this->t('Publishing information'),
      '#open' => FALSE,
      '#group' => 'advanced',
      '#weight' => 5,
    ];
    $form['status']['#group'] = 'publishing_information';

    if ($this->getEntity()->isNew()) {
      $form['status']['widget']['value']['#default_value'] = $this->config->get('status_default');
    }

    return $form;
  }

}

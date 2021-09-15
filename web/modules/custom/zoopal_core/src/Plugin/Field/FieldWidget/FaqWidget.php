<?php

namespace Drupal\zoopal_core\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines the 'zoopal_core_faq' field widget.
 *
 * @FieldWidget(
 *   id = "zoopal_core_faq",
 *   label = @Translation("FAQ"),
 *   field_types = {"zoopal_core_faq"},
 * )
 */
class FaqWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {

    $element['question'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Question'),
      '#default_value' => isset($items[$delta]->question) ? $items[$delta]->question : NULL,
    ];
    $element['answer'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Answer'),
      '#default_value' => isset($items[$delta]->answer) ? $items[$delta]->answer : NULL,
    ];

    return $element;
  }

}

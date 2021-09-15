<?php

namespace Drupal\zoopal_creature\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines the 'zoopal_creature_timeline' field widget.
 *
 * @FieldWidget(
 *   id = "zoopal_creature_timeline",
 *   label = @Translation("Timeline"),
 *   field_types = {"zoopal_creature_timeline"},
 * )
 */
class TimelineWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {

    $element['date'] = [
      '#type' => 'date',
      '#title' => $this->t('When it happened'),
      '#date_date_format' => 'Y-m-d',
      '#default_value' => isset($items[$delta]->date) ? $items[$delta]->date : NULL,
    ];

    $element['description'] = [
      '#type' => 'textfield',
      '#title' => $this->t('What happened'),
      '#default_value' => isset($items[$delta]->description) ? $items[$delta]->description : NULL,
    ];

    return $element;
  }

}

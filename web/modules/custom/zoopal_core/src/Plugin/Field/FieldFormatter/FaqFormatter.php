<?php

namespace Drupal\zoopal_core\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'FAQ' formatter.
 *
 * @FieldFormatter(
 *   id = "zoopal_core_faq",
 *   label = @Translation("FAQ"),
 *   field_types = {
 *     "zoopal_core_faq"
 *   }
 * )
 */
class FaqFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];

    foreach ($items as $delta => $item) {
      $element[$delta] = [
        'question' => [
          '#type' => 'html_tag',
          '#tag' => 'h3',
          '#value' => $item->question,
        ],
        'answer' => [
          '#markup' => nl2br($item->answer),
        ]
      ];
    }

    return $element;
  }

}

<?php

namespace Drupal\zoopal_creature\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'Timeline' formatter.
 *
 * @FieldFormatter(
 *   id = "zoopal_creature_timeline",
 *   label = @Translation("Timeline"),
 *   field_types = {
 *     "zoopal_creature_timeline"
 *   }
 * )
 */
class TimelineFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    foreach ($items as $delta => $item) {
      $elements[$delta] = [
        '#plain_text' => $item->date . ': ' . $item->description,
      ];
    }

    return $elements;
  }

}

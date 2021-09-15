<?php

namespace Drupal\zoopal_core\Plugin\Field\FieldType;

use Drupal\Component\Utility\Random;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Defines the 'zoopal_core_faq' field type.
 *
 * @FieldType(
 *   id = "zoopal_core_faq",
 *   label = @Translation("FAQ"),
 *   category = @Translation("General"),
 *   default_widget = "string_textfield",
 *   default_formatter = "string"
 * )
 *
 * @DCG
 * If you are implementing a single value field type you may want to inherit
 * this class form some of the field type classes provided by Drupal core.
 * Check out /core/lib/Drupal/Core/Field/Plugin/Field/FieldType directory for a
 * list of available field type implementations.
 */
class FaqItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('question')->getValue();
    return $value === NULL || $value === '';
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {

    // @DCG
    // See /core/lib/Drupal/Core/TypedData/Plugin/DataType directory for
    // available data types.
    $properties['question'] = DataDefinition::create('string')
      ->setLabel(t('Question'))
      ->setRequired(TRUE);

    $properties['answer'] = DataDefinition::create('string')
      ->setLabel(t('Answer'))
      ->setRequired(TRUE);

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {

    $columns = [
      'question' => [
        'type' => 'varchar',
        'not null' => FALSE,
        'description' => 'Question',
        'length' => 255,
      ],
      'answer' => [
        'type' => 'text',
        'not null' => FALSE,
        'description' => 'Answer',
      ],
    ];

    $schema = [
      'columns' => $columns,
      // @DCG Add indexes here if necessary.
    ];

    return $schema;
  }

  /**
   * {@inheritdoc}
   */
  public static function generateSampleValue(FieldDefinitionInterface $field_definition) {
    $random = new Random();
    $values['question'] = $random->word(mt_rand(1, 50));
    $values['answer'] = $random->word(mt_rand(1, 50));
    return $values;
  }

}

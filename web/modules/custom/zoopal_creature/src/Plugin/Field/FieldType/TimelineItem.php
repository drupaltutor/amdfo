<?php

namespace Drupal\zoopal_creature\Plugin\Field\FieldType;

use Drupal\Component\Utility\Random;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;
use Drupal\datetime\Plugin\Field\FieldType\DateTimeItem;

/**
 * Defines the 'zoopal_creature_timeline' field type.
 *
 * @FieldType(
 *   id = "zoopal_creature_timeline",
 *   label = @Translation("Timeline"),
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
class TimelineItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('date')->getValue();
    return $value === NULL || $value === '';
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {

    $properties['date'] = DataDefinition::create('datetime_iso8601')
    ->setLabel(t('date'))
    ->setRequired(TRUE);
    $properties['description'] = DataDefinition::create('string')
      ->setLabel(t('Description'))
      ->setRequired(TRUE);

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public function getConstraints() {
    $constraints = parent::getConstraints();
    return $constraints;

    $constraint_manager = \Drupal::typedDataManager()->getValidationConstraintManager();

    // @DCG Suppose our value must not be longer than 10 characters.
    $options['value']['Length']['max'] = 10;

    // @DCG
    // See /core/lib/Drupal/Core/Validation/Plugin/Validation/Constraint
    // directory for available constraints.
    $constraints[] = $constraint_manager->create('ComplexData', $options);
    return $constraints;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {

    $columns = [
      'date' => [
        'description' => 'The date value.',
        'type' => 'varchar',
        'length' => 20,
      ],
      'description' => [
        'type' => 'varchar',
        'description' => 'The description value',
        'length' => 255,
      ],
    ];

    $schema = [
      'columns' => $columns,
      'indexes' => [
        'date' => ['date'],
      ],
    ];

    return $schema;
  }

  /**
   * {@inheritdoc}
   */
  public static function generateSampleValue(FieldDefinitionInterface $field_definition) {
    $random = new Random();
    $timestamp = REQUEST_TIME - mt_rand(0, 86400 * 365);
    $values['date'] = gmdate(DateTimeItem::DATE_STORAGE_FORMAT, $timestamp);
    $values['description'] = $random->word(mt_rand(1, 50));
    return $values;
  }

}

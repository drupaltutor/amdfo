<?php

namespace Drupal\zoopal_species\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\zoopal_species\Entity\ZoopalSpecies;

/**
 * Plugin implementation for displaying information from species entity reference fields.
 *
 * @FieldFormatter(
 *   id = "zoopal_species_name",
 *   label = @Translation("Species Name"),
 *   field_types = {
 *     "entity_reference"
 *   }
 * )
 */
class SpeciesName extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public static function isApplicable(FieldDefinitionInterface $field_definition) {
    return $field_definition->getSetting('target_type') === 'zoopal_species';
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    foreach ($items as $delta => $item) {
      /** @var ZoopalSpecies $species */
      $species = $item->entity;

      if ($this->getSetting('include_common_names') && $common_names = $species->get('common_names')) {
        $name = $this->t('@scientific_name, a.k.a @common_names', [
          '@scientific_name' => $species->get('scientific_name'),
          '@common_names' => implode(', ', $common_names),
        ]);
      }
      else {
        $name = $species->get('scientific_name');
      }

      $elements[$delta] = [
        '#type' => 'html_tag',
        '#tag' => 'h2',
        '#value' => $name,
      ];
    }

    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $elements = parent::settingsForm($form, $form_state);
    $elements['include_common_names'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Include common names'),
      '#default_value' => $this->getSetting('include_common_names'),
    ];
    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'include_common_names' => TRUE,
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary()
  {
    $summary = [];
    if ($this->getSetting('include_common_names')) {
      $summary[] = $this->t('Include common names');
    }
    else {
      $summary[] = $this->t('Do not include common names');
    }
    return $summary;
  }

}

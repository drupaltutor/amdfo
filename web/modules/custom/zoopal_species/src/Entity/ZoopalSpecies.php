<?php

namespace Drupal\zoopal_species\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\zoopal_species\ZoopalSpeciesInterface;

/**
 * Defines the species entity type.
 *
 * @ConfigEntityType(
 *   id = "zoopal_species",
 *   label = @Translation("Species"),
 *   label_collection = @Translation("Species"),
 *   label_singular = @Translation("species"),
 *   label_plural = @Translation("species"),
 *   label_count = @PluralTranslation(
 *     singular = "@count species",
 *     plural = "@count specieses",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\zoopal_species\ZoopalSpeciesListBuilder",
 *     "form" = {
 *       "add" = "Drupal\zoopal_species\Form\ZoopalSpeciesForm",
 *       "edit" = "Drupal\zoopal_species\Form\ZoopalSpeciesForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm"
 *     }
 *   },
 *   config_prefix = "zoopal_species",
 *   admin_permission = "administer zoopal_species",
 *   links = {
 *     "collection" = "/admin/zoopal/config/species",
 *     "add-form" = "/admin/zoopal/config/species/add",
 *     "edit-form" = "/admin/zoopal/config/species/{zoopal_species}",
 *     "delete-form" = "/admin/zoopal/config/species/{zoopal_species}/delete"
 *   },
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "scientific_name",
 *     "uuid" = "uuid"
 *   },
 *   config_export = {
 *     "id",
 *     "scientific_name",
 *     "common_names",
 *     "natural_habitat",
 *     "description"
 *   }
 * )
 */
class ZoopalSpecies extends ConfigEntityBase implements ZoopalSpeciesInterface {

  /**
   * The species ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The species scientific name.
   *
   * @var string
   */
  protected $scientific_name;

  /**
   * The species common names
   *
   * @var array
   */
  protected $common_names;

  /**
   * The natural habitat of this species
   *
   * @var string
   */
  protected $natural_habitat;

  /**
   * The species status.
   *
   * @var bool
   */
  protected $status;

  /**
   * The zoopal_species description.
   *
   * @var string
   */
  protected $description;

}

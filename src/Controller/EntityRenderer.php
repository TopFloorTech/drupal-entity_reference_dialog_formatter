<?php

namespace Drupal\entity_reference_dialog_formatter\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Language\Language;

class EntityRenderer extends ControllerBase {
  /**
   * Render a given entity with the given view mode.
   *
   * @param EntityInterface $entity
   *   The entity being forwarded.
   * @param string $viewMode
   *   The view mode to use, with "full" being the default value.
   *
   * @return array
   *   The render array for the entity.
   */
  public function render(EntityInterface $entity, $viewMode = 'full') {
    $viewBuilder = \Drupal::entityTypeManager()->getViewBuilder($entity->getEntityTypeId());
    $langcode = \Drupal::languageManager()->getLanguage(Language::TYPE_CONTENT);
    $output = $viewBuilder->view($entity, $viewMode, $langcode);
    return $output;
  }
}

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
   * @param string $view_mode
   *   The view mode to use, with "full" being the default value.
   *
   * @return array
   *   The render array for the entity.
   */
  public function render(EntityInterface $entity, $view_mode = 'full') {
    $viewBuilder = \Drupal::entityTypeManager()->getViewBuilder($entity->getEntityTypeId());
    $langcode = \Drupal::languageManager()->getLanguage(Language::TYPE_CONTENT);
    $output = $viewBuilder->view($entity, $view_mode, $langcode);
    return $output;
  }

  /**
   * The _title_callback for the modal.
   *
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   The entity.
   *
   * @return string
   *   The page title.
   */
  public function title(EntityInterface $entity) {
    return \Drupal::service('entity.repository')->getTranslationFromContext($entity)->label();
  }
}

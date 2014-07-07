<?php

/**
 * @file
 * Contains \Drupal\chosen\Plugin\Field\FieldWidget\ChosenWidget.
 */

namespace Drupal\chosen\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\options\Plugin\Field\FieldWidget\SelectWidget;

/**
 * Plugin implementation of the 'chosen_select' widget.
 *
 * @FieldWidget(
 *   id = "chosen_select",
 *   label = @Translation("Chosen"),
 *   field_types = {
 *     "list_integer",
 *     "list_float",
 *     "list_text"
 *   },
 *   multiple_values = TRUE
 * )
 */
class ChosenWidget extends SelectWidget {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, array &$form_state) {
    $element = parent::formElement($items, $delta, $element, $form, $form_state);

    $element += array(
      '#type' => 'select',
      '#options' => $this->getOptions($items[$delta]),
      '#default_value' => $this->getSelectedOptions($items, $delta),
      // Do not display a 'multiple' select box if there is only one option.
      '#multiple' => $this->multiple && count($this->options) > 1,
      '#chosen' => 1,
    );

    return $element;
  }

}

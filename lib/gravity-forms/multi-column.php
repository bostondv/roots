<?php

/**
 * Multi-column Gravity Forms
 *
 * How to use:
 * - add .gform_columns class to the form
 * - add a "section" element with a bootstrap column class at the beginning of
 *   each column
 *
 * NOTE: Only one row is currently supported and requires some javascript hacks
 * (see: assets/js/plugins/bootstrap-gravity-forms.js)
 */

if (class_exists('GFForms')) {
  add_filter('gform_field_content', 'gform_column_splits', 10, 5);
}

function gform_column_splits($content, $field, $value, $lead_id, $form_id) {
  if (!is_admin()) {

    // target section breaks
    if ($field['type'] == 'section') {
      $form = RGFormsModel::get_form_meta($form_id, true);

      // check for the presence of our special multi-column form class
      if (!empty($form['cssClass'])) {
        $form_class = explode(' ', $form['cssClass']);
        $form_class_matches = array_intersect($form_class, array('gform_columns'));
      }

      // check for the presence of our special section break column class
      if (!empty($field['cssClass'])) {
        $field_class = explode(' ', $field['cssClass']);
        $field_class_matches = false;
        foreach ($field_class as $class) {
          if (strpos($class, 'col') === 0) {
            $field_class_matches = true;
          }
        }
      }

      // if we have a column break field in a multi-column form, perform the list split
      if (!empty($form_class_matches) && $field_class_matches === true) {

        // we'll need to retrieve the form's properties for consistency
        $form = RGFormsModel::add_default_properties($form);
        $description_class = rgar($form, 'descriptionPlacement') == 'above' ? 'description_above' : 'description_below';

        // close current field's li and ul and begin a new list with the same form properties
        return '</li></ul><ul class="gform_fields '.$form['labelPlacement'].' '.$description_class.' '.$field['cssClass'].'"><li class="gfield gsection">';

      }
    }
  }

  return $content;
}

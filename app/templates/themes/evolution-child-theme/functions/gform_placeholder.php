<?php
/**
 * Add a custom placeholder field to the Gravity Forms field editor
 * Borrowed from http://www.wpbeginner.com/wp-tutorials/how-to-add-placeholder-text-in-gravity-forms/
*/
add_action( 'gform_field_standard_settings', 'my_standard_settings', 10, 2);

function my_standard_settings( $position, $form_id ) {


  /**
   * Create settings on position 25 (right after Field Label)
   */
  if ( $position == 25 ) {
    echo '
    <li class="admin_label_setting field_setting" style="display: list-item; ">

      <label for="field_placeholder">Placeholder Text
        <!-- Tooltip to help users understand what this field does -->
        <a href="javascript:void(0);" class="tooltip tooltip_form_field_placeholder" tooltip="&lt;h6&gt;Placeholder&lt;/h6&gt;Enter the placeholder/default text for this field.">(?)</a>
      </label>
      <input type="text" id="field_placeholder" class="fieldwidth-3" size="35" onkeyup="SetFieldProperty('placeholder', this.value);">

    </li>';
  }
}


/**
 * Now we execute some javascript technicalitites for the field to load correctly
 */
add_action( 'gform_editor_js', 'my_gform_editor_js' );

function my_gform_editor_js() {
  echo '
  <script>
    //binding to the load field settings event to initialize the checkbox
    jQuery(document).bind("gform_load_field_settings", function(event, field, form) {
      jQuery("#field_placeholder").val(field["placeholder"]);
    });
  </script>';
}


/**
 * We use jQuery to read the placeholder value and inject it to its field
 */
add_action( 'gform_enqueue_scripts', 'my_gform_enqueue_scripts', 10, 2 );

function my_gform_enqueue_scripts( $form, $is_ajax = false ) {
  echo '<script>';


  /**
   * Loop through each of the form fields
   */
  foreach( $form['fields'] as $i => $field ) {


    /**
     * If the field has an assigned placeholder. inject it as a new property to the field using jQuery
     */
    if ( isset($field['placeholder'] ) && !empty( $field['placeholder'] ) ) {
      echo 'jQuery("#input_' . $form['id'] . '_' . $field['id'] . '").attr("placeholder", "' . $field['placeholder'] . '");';
    }
  }

  echo '</script>';
}

?>
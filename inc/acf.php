<?php 

add_filter('acf/settings/load_json', 'my_acf_json_load_point');
/**
 *
 * Add our acf-json to the activated theme
 *
 */
function my_acf_json_load_point( $paths ) {
        
  $paths[] = SSM_PRICING_TABLES_DIR . 'acf-json';

  return $paths;
    
}

add_filter('acf/load_field/key=field_5879a8c8a42d1', 'acf_load_standard_feature_choices');
/**
 *
 * Load values from "Plan Features" options so that it can be called in each plan dynamically
 *
 */
function acf_load_standard_feature_choices( $field ) {

    // reset choices
    $field['choices'] = array();


    // if has rows
    if( have_rows('standard_feature_list') ) {

        // while has rows
        while( have_rows('standard_feature_list') ) {

            // instantiate row
            the_row();

            // vars
            $value = get_sub_field('feature');
            $label = get_sub_field('feature');


            // append to choices
            $field['choices'][ $value ] = $label;

        }

    }


    // return the field
    return $field;

}
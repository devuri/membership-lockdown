<?php

namespace simForm;

/**
 * Sim_Form_Helper
 *
 * form helper class
 */
final class Sim_Form_Helper
{

  /**
   * require
   *
   * set field as required, defaults to false
   *
   * @param  boolean $required
   * @return
   */
  public function require($required = false){
    if ($required) {
      $require = ' <span class="description">(required)</span>';
    } else {
      $require = '';
    }
    return $require;
  }

  /**
   * Input Field
   *
   * @param  string  $fieldname     the name of the field
   * @param  boolean $required set if this field is a required field
   * @param  string  $type     the field type
   * @return
   */
  public function input($fieldname='name',$required = false,$type='text'){
    $fieldname = strtolower($fieldname);
    // set reuired
    $require = $this->require($required);

    // lets build out the input
    $input  = '<!-- input field '.$fieldname.'_input -->';
    $input .= '<tr class="input">';
    $input .= '<th>';
    $input .= '<label for="'.str_replace(" ", "_", $fieldname).'">';
    $input .= ucwords(str_replace("_", " ", $fieldname));
    $input .= $require;
    $input .= '</label>';
    $input .= '</th>';
    $input .= '<td>';
    $input .= '<input type="'.$type.'" name="'.str_replace(" ", "_", $fieldname).'" id="'.str_replace(" ", "_", $fieldname).'" aria-describedby="'.str_replace(" ", "-", $fieldname).'-description" value="" class="uk-input">';
    $input .= '<p class="description" id="'.str_replace(" ", "-", $fieldname).'-description">';
    $input .= 'Enter '.strtolower(str_replace("_", " ", $fieldname));
    $input .= '<strong>.</strong>';
    $input .= '</p>';
    $input .= '</td>';
    $input .= '</tr>';
    $input .= '<!-- input field '.$fieldname.'_input -->';
    return $input;
  }

  /**
   * page_list building our own $pages array
   * @param  array  $arg [description]
   * @link https://developer.wordpress.org/reference/functions/get_pages/
   * @return array
   */
  public function page_list($arg = array()){
    $arg = array(
      'sort_column' => 'post_date',
      'sort_order' => 'desc'
    );
    $pages = get_pages($arg);
    $selectpages = array();
    foreach ($pages as $pkey => $page) {
      $selectpages[$pkey] = array(
        $page->ID => $page->post_title,
      );
    }
    // breakdown to key.value pairs
    foreach ($selectpages as $wpkey => $wpages) {
      foreach ($wpages as $vkey => $val) {
        $page_list[$vkey] = $val;
      }
    }
    return $page_list;
  }

  /**
   * select field
   * @param  array  $options [description]
   * @return [type]          [description]
   */
  public function select($options = array(),$fieldname = 'name',$required = false){
    // set reuired
    $require = $this->require($required);
    $defualt_select = 'Select a page';

    // lets build out the select field
    $select  = '';
    $select .= '<tr class="input">';
    $select .= '<th>';
    $select .= '<label for="'.str_replace(" ", "_", $fieldname).'">';
    $select .= ucwords(str_replace("_", " ", $fieldname));
    $select .= $require;
    $select .= '</label>';
    $select .= '</th>';
    $select .= '<td>';
    $select .= '<select name="'.strtolower(str_replace(" ", "_", $fieldname)).'" id="'.strtolower(str_replace(" ", "_", $fieldname)).'" class="uk-select">';
    $select .= '<option selected="selected">'.$defualt_select.'</option>';
    /**
     * Options list Output
     * @var array $options
     */
    if (is_array($options)) {
      foreach ($options as $optkey => $optvalue) {
        $select .= '<option value="'.$optkey.'">'.$optvalue.'</option>';
      }
    }
    $select .= '</select>';
    $select .= '<p class="description" id="'.str_replace(" ", "-", $fieldname).'-description">';
    $select .= 'Enter '.strtolower(str_replace("_", " ", $fieldname));
    $select .= '<strong>.</strong>';
    $select .= '</p>';
    $select .= '</td>';
    $select .= '</tr>';
    $select .= '<!-- select field '.$fieldname.'_input -->';
    return $select;
  }

  /**
   * Textarea
   *
   * @param  string  $fieldname     field name
   * @param  boolean $required set the filed to required
   * @return
   */
  public function textarea($fieldname='name',$required = false){
    $fieldname = strtolower($fieldname);
    // set reuired
    $require = $this->require($required);

    // lets build out the textarea
    $textarea  = '<!-- '.$fieldname.'_textarea -->';
    $textarea .= '<tr class="textarea">';
    $textarea .= '<th>';
    $textarea .= '<label for="'.str_replace(" ", "_", $fieldname).'">';
    $textarea .= ucwords(str_replace("_", " ", $fieldname));
    $textarea .= $require;
    $textarea .= '</label>';
    $textarea .= '</th>';
    $textarea .= '<td>';
    $textarea .= '<textarea class="uk-textarea" name="'.str_replace(" ", "_", $fieldname).'_textarea" rows="8" cols="50">';
    $textarea .= '</textarea>';
    $textarea .= '<p class="description" id="'.str_replace(" ", "-", $fieldname).'-description">';
    $textarea .= 'Enter '.strtolower(str_replace("_", " ", $fieldname));
    $textarea .= '<strong>.</strong>';
    $textarea .= '</p>';
    $textarea .= '</td>';
    $textarea .= '</tr>';
    $textarea .= '<!-- '.$fieldname.'_textarea -->';
    return $textarea;
  }

  /**
   * Custom version of the WP Dropdown Category list
   *
   * @param  string $fieldname   field name
   * @param  array $args define custom arguments
   * @return
   * @link https://developer.wordpress.org/reference/functions/wp_dropdown_categories/
   */
  public function categorylist($fieldname=null,$args = array()){
    $require = $this->require($required);

    $catlist_args = array(
      'show_option_all'    => '',
      'show_option_none'   => '',
      'option_none_value'  => '-1',
      'orderby'            => 'ID',
      'order'              => 'ASC',
      'show_count'         => 0,
      'hide_empty'         => 1,
      'child_of'           => 0,
      'exclude'            => '',
      'echo'               => 0,
      'selected'           => 0,
      'hierarchical'       => 0,
      'name'               => strtolower(str_replace(" ", "_", $fieldname)).'set_category',
      'id'                 => '',
      'class'              => 'uk-select',
      'depth'              => 0,
      'tab_index'          => 0,
      'taxonomy'           => 'category',
      'hide_if_empty'      => false,
      'value_field'	     => 'term_id',
    );
    // ref https://developer.wordpress.org/reference/functions/wp_dropdown_categories/
    $categories = '<tr class="input-select">';
    $categories .= '<th><label for="select_dropdown">Select a Category</label></th>';
    $categories .= '<td>';
    $categories .= wp_dropdown_categories($catlist_args);
    $categories .= '</td>';
    $categories .= '</tr>';
    return $categories;
  }

  /**
   * Make Table
   *
   * Use this to create a table for the form
   * @param  string $tag decide to open or close table
   * @param  string $tbclass ad css class
   * @return
   */
  public function table($tag='close', $tbclass=''){
    if ($tag === 'open') {
      // lets open tags for the table
      $table  = '<table class="form-table '.$tbclass.'" role="presentation">';
      $table .= '<tbody>';
    } elseif ($tag === 'close') {
      // lets close the tags for the table
      $table  = '</tbody>';
      $table .= '</table>';
    }
    return $table;
  }

  /**
   * input_val
   *
   * Get the input field $_POST data
   * @param  string $input_field input name
   * @return string
   */
  public function input_val($input_field=null){
    $input = $_POST[$input_field];
    if ( isset( $_POST[$input_field] )) {
      return $input;
    }
  }

  /**
   * nonce field
   *
   * @param  string $fieldname nonce field name
   * @return
   * @link https://developer.wordpress.org/reference/functions/wp_nonce_field/
   */
  public function nonce($wpnonce = '_swa_page_wpnonce'){
    return wp_nonce_field( -1, $wpnonce, true , true);
  }

  /**
   * nonce_check
   *
   * @param  string $noncefield [description]
   * @return
   * @link https://developer.wordpress.org/reference/functions/wp_verify_nonce/
   */
  public function verify_nonce($noncefield='_swa_page_wpnonce'){
    /**
     * Lets verify the @return boolean
     */
    if ( ! isset( $_POST[$noncefield] ) || ! wp_verify_nonce( $_POST[$noncefield] )) {
      return false;
    } else {
      return true; // nonce is invalid
    }
  }

}

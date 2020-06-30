<?php

if( !defined( 'ABSPATH' ) ): exit(); endif;

// list of field group IDs used in my plugin
$acf_dir = get_stylesheet_directory() . "/acf-json";
$acf_groups = array_diff(scandir($acf_dir), array('..', '.'));
foreach($acf_groups as $key => $acf_group_filename):
	$acf_groups[$key] = basename($acf_group_filename, '.json');
endforeach;

if(!class_exists('tdc_acf_group_save')):
	class tdc_acf_group_save {

	  //private $groups = $acf_groups;

	  public function __construct() {
	    // add fitler before acf saves a group
	    add_action('acf/update_field_group', array($this, 'update_field_group'), 1, 1);
	  } // end public function __construct

	  public function update_field_group($group) {
	    // called when ACF save the field group to the DB
	    if (in_array($group['key'], $acf_groups)) {
	      // if it is one of my groups then add a filter on the save location
	      // high priority to make sure it is not overrridded, I hope
	      add_filter('acf/settings/save_json',  array($this, 'override_location'), 9999);
	    }
	    return $group;
	  } // end public function update_field_group

	  public function override_location($path) {
	    // remove this filter so it will not effect other goups
	    remove_filter('acf/settings/save_json',  array($this, 'override_location'), 9999);
	    // override save path
	    $path = dirname($acf_dir);
	    return $path;
	  } // end public function override_json_location

	} // end class my_pluging_name_acf_group_save

	new tdc_acf_group_save();

endif;

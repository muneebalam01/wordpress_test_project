<?php 

// Register Taxonomy Project Type
function create_projecttype_tax() {

	$labels = array(
		'name'              => _x( 'Project Types', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Project Type', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Project Types', 'textdomain' ),
		'all_items'         => __( 'All Project Types', 'textdomain' ),
		'parent_item'       => __( 'Parent Project Type', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Project Type:', 'textdomain' ),
		'edit_item'         => __( 'Edit Project Type', 'textdomain' ),
		'update_item'       => __( 'Update Project Type', 'textdomain' ),
		'add_new_item'      => __( 'Add New Project Type', 'textdomain' ),
		'new_item_name'     => __( 'New Project Type Name', 'textdomain' ),
		'menu_name'         => __( 'Project Type', 'textdomain' ),
	);
	$args = array(
		'labels' => $labels,
		'description' => __( '', 'textdomain' ),
		'hierarchical' => true,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'show_in_quick_edit' => true,
		'show_admin_column' => false,
		'show_in_rest' => true,
	);
	register_taxonomy( 'projecttype', array('project'), $args );

}
add_action( 'init', 'create_projecttype_tax' );
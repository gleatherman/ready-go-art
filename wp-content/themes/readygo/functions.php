<?php

add_action( 'admin_menu', 'remove_menus' );
add_action( 'init', 'create_post_type' );
add_action( 'init', 'create_taxonomies', 0 );
add_action( 'init', 'custom_post_type_sub_page_urls' );
add_action( 'init', 'register_menus' );
add_action( 'init', 'readygo_init' );
add_action( 'nav_menu_css_class', 'add_current_nav_class', 10, 2 );

add_filter( 'ninja_forms_field', 'filter_fetch_jid', 10, 27 );
add_filter( 'posts_orderby', 'custom_cpt_order' );

add_image_size( 'post-image', 620, 275, true );

add_theme_support( 'post-thumbnails' );

function readygo_init() {
    if (!is_admin()) {
        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery', false );
    }
}

function add_current_nav_class( $classes, $item ) {
	global $post;
	$current_post_type      = get_post_type_object( get_post_type( $post->ID ) );
	$current_post_type_slug = $current_post_type->rewrite[ slug ];
	$menu_slug              = strtolower( trim( $item->url ) );
	if ( strpos( $menu_slug, $current_post_type_slug ) !== false ) {
		$classes[] = 'current-menu-item';
	}

	return $classes;
}

function create_post_type() {
	register_post_type( 'collection',
		array(
			'labels'      => array(
				'name'          => __( 'Collections' ),
				'singular_name' => __( 'Collection' )
			),
			'public'      => true,
			'has_archive' => true,
			'menu_icon'   => 'dashicons-book',
			'rewrite'     => array( 'slug' => 'collections', 'with_front' => false ),
			'supports'    => array( 'title', 'editor', 'thumbnail' ),
			'taxonomies'  => array( 'post_tag' )
		)
	);

	register_post_type( 'tool',
		array(
			'labels'             => array(
				'name'          => __( 'Mobile Tools' ),
				'singular_name' => __( 'Tool' )
			),
			'public'             => true,
			'has_archive'        => true,
			'menu_icon'          => 'dashicons-location',
			'publicly_queryable' => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'tools', 'with_front' => false ),
			'supports'           => array( 'title', 'thumbnail' ),
			'taxonomies'         => array( 'post_tag' )
		)
	);
}

function create_taxonomies() {
	register_taxonomy(
		'collection_location',
		'collection',
		array(
			'hierarchical' => true,
			'labels'       => array(
				'name'         => 'Collection Locations',
				'add_new_item' => __( 'Add New Location' )
			),
			'query_var'    => true,
			'rewrite'      => true
		)
	);

	register_taxonomy(
		'tool_category',
		'tool',
		array(
			'hierarchical' => true,
			'label'        => 'Tool Categories',
			'query_var'    => true,
			'rewrite'      => true
		)
	);

	register_taxonomy(
		'tool_location',
		'tool',
		array(
			'hierarchical' => true,
			'labels'       => array(
				'name'         => 'Tool Locations',
				'add_new_item' => __( 'Add New Location' )
			),
			'query_var'    => true,
			'rewrite'      => true
		)
	);

	register_taxonomy(
		'tool_option',
		'tool',
		array(
			'hierarchical' => true,
			'labels'       => array(
				'name'         => 'Tool Options',
				'add_new_item' => __( 'Add New Option' )
			),
			'query_var'    => true,
			'rewrite'      => true
		)
	);

	register_taxonomy(
		'tool_engagement',
		'tool',
		array(
			'hierarchical' => true,
			'labels'       => array(
				'name'         => 'Tool Engagements',
				'add_new_item' => __( 'Add New Engagement' )
			),
			'query_var'    => true,
			'rewrite'      => true
		)
	);
}

function register_menus() {
	register_nav_menus(
		array(
			'nav-menu' => __( 'Navigation Menu' )
		)
	);
}

function remove_menus() {
	// Hide Comments menu item in admin
	remove_menu_page( 'edit-comments.php' );
}

function custom_cpt_order( $orderby ) {
	global $wpdb;
	if ( is_archive() && get_query_var( 'post_type' ) == 'tool' ) {
		return "$wpdb->posts.post_title ASC";
	}

	return $orderby;
}

function custom_post_type_sub_page_urls() {
	add_rewrite_tag( '%subpage%', '([^&]+)' );
	add_rewrite_rule(
		'tools/([^/]*)/([^/]*)',
		'index.php?tool=$matches[1]&subpage=$matches[2]',
		'top'
	);
	flush_rewrite_rules();
}

function filter_fetch_jid( $data, $field_id ) {
	if ( $field_id == 16 ) {
		global $post;
		$artist_email          = get_field( 'artist_email_address', $post->ID );
		$data['default_value'] = $artist_email;
	}

	return $data;
}

function get_custom_taxonomy_list( $post_id, $type ) {
	$terms = get_the_terms( $post_id, $type );
	if ( $terms && ! is_wp_error( $terms ) ) {
		$taxonomies = array();
		foreach ( $terms as $term ) {
			$taxonomies[] = $term->term_id;
		}

		return join( ',', $taxonomies );
	}
}

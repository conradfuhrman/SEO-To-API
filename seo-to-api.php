<?php
/**
 * Plugin Name:       SEO to API
 * Plugin URI:        https://github.com/conradfuhrman/SEO-To-API
 * Description:       Expose the meta of the SEO Framework to the WP API
 * Version:           1.0
 * Author:            Conrad Fuhrman
 * Author URI:        https://github.com/conradfuhrman/
 *
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}

add_action( 'rest_api_init', function() {
  $str = [
    'type'         => 'string',
    'single'       => true,
    'show_in_rest' => true,
  ];

  register_meta('post', '_genesis_title', $str);
  register_meta('post', '_genesis_description', $str);
  register_meta('post', '_genesis_canonical_uri', $str);
  register_meta('post', 'redirect', $str);
  register_meta('post', '_social_image_url', $str);
  register_meta('post', '_social_image_id', $str);
  register_meta('post', '_genesis_noindex', $str);
  register_meta('post', '_genesis_nofollow', $str);
  register_meta('post', '_genesis_noarchive', $str);
  register_meta('post', 'exclude_local_search', $str);
  register_meta('post', 'exclude_from_archive', $str);
  register_meta('post', '_open_graph_title', $str);
  register_meta('post', '_open_graph_description', $str);
  register_meta('post', '_twitter_title', $str);
  register_meta('post', '_twitter_description', $str);

});
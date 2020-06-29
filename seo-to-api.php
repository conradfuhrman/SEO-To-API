<?php
/**
 * Plugin Name:       SEO to API
 * Plugin URI:        https://github.com/conradfuhrman/SEO-To-API
 * Description:       Expose the meta of the SEO Framework to the WP API
 * Version:           1.1
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

  $args = [
    'name' => $_REQUEST['slug'],
    'post_type'   => 'page',
    'post_status' => 'publish',
    'numberposts' => 1
  ];

  $post = get_posts($args)[0];



  register_rest_field(['post', 'page', 'work'], 'meta_title', [
    'get_callback' => function () use ($post) { return html_entity_decode(the_seo_framework()->get_title($post->ID)); }
  ]);

  register_rest_field(['post', 'page', 'work'], 'meta_description', [
    'get_callback' => function () use ($post) { return html_entity_decode(the_seo_framework()->get_description($post->ID)); }
  ]);

  register_rest_field(['post', 'page', 'work'], 'meta_social_image_url', [
    'get_callback' => function () use ($post) { return html_entity_decode(the_seo_framework()->get_image_from_cache($post->ID)); }
  ]);

  register_rest_field(['post', 'page', 'work'], 'meta_open_graph_title', [
    'get_callback' => function () use ($post) { return html_entity_decode(the_seo_framework()->get_open_graph_title($post->ID)); }
  ]);

  register_rest_field(['post', 'page', 'work'], 'meta_open_graph_description', [
    'get_callback' => function () use ($post) { return html_entity_decode(the_seo_framework()->get_open_graph_description($post->ID)); }
  ]);

  register_rest_field(['post', 'page', 'work'], 'meta_twitter_title', [
    'get_callback' => function () use ($post) { return html_entity_decode(the_seo_framework()->get_twitter_title($post->ID)); }
  ]);

  register_rest_field(['post', 'page', 'work'], 'meta_twitter_description', [
    'get_callback' => function () use ($post) { return html_entity_decode(the_seo_framework()->get_twitter_description($post->ID)); }
  ]);

});
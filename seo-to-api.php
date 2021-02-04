<?php
/**
 * Plugin Name:       SEO to API
 * Plugin URI:        https://github.com/conradfuhrman/SEO-To-API
 * Description:       Expose the meta of the SEO Framework to the WP API
 * Version:           1.3
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

  if (isset($_REQUEST['slug'])) {
    $args = [
      'name' => $_REQUEST['slug'],
      'post_type'   => ['post', 'page', 'works'],
      'post_status' => 'publish',
      'numberposts' => 1
    ];

    $post = get_posts($args)[0];



    register_rest_field(['post', 'page', 'works'], 'meta_title', [
      'get_callback' => function () use ($post) { return html_entity_decode(the_seo_framework()->get_title($post->ID)); }
    ]);

    register_rest_field(['post', 'page', 'works'], 'meta_description', [
      'get_callback' => function () use ($post) { return html_entity_decode(the_seo_framework()->get_description($post->ID)); }
    ]);

    register_rest_field(['post', 'page', 'works'], 'meta_social_image_url', [
      'get_callback' => function () use ($post) { return html_entity_decode(the_seo_framework()->get_social_image( ['post_id' => $post->ID,])); }
    ]);

    register_rest_field(['post', 'page', 'works'], 'meta_open_graph_title', [
      'get_callback' => function () use ($post) { return html_entity_decode(the_seo_framework()->get_open_graph_title($post->ID)); }
    ]);

    register_rest_field(['post', 'page', 'works'], 'meta_open_graph_description', [
      'get_callback' => function () use ($post) { return html_entity_decode(the_seo_framework()->get_open_graph_description($post->ID)); }
    ]);

    register_rest_field(['post', 'page', 'works'], 'meta_twitter_title', [
      'get_callback' => function () use ($post) { return html_entity_decode(the_seo_framework()->get_twitter_title($post->ID)); }
    ]);

    register_rest_field(['post', 'page', 'works'], 'meta_twitter_description', [
      'get_callback' => function () use ($post) { return html_entity_decode(the_seo_framework()->get_twitter_description($post->ID)); }
    ]);
  }

});
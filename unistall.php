<?php
/**
 * Trigger this on unistalll
 *
 * @package bgcPlugin
 */
if(!defined('WP_UNINSTALL_PLUGIN')){
    die;
}

global $wpdb;
$wpdb->query('DELETE  FROM  wp_posts WHERE post_type = "books"');
$wpdb->query('DELETE FOM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)');
$wpdb->query('DELETE FOM wp_term_relationships  WHERE objact_id NOT IN (SELECT id FROM wp_posts)');
<?php
// Triggered on plugin uninstall


/**
 * @package settingNotify
 * @version 1.0.0
 */

 defined('WP_UNINSTALL_FUNCTION') or die('You do not have permissions');


 // Clear all checks stored in database. 
 // $wpdb provides access to the database
 // Using SQL provides a lower level understanding at this time as I am unsure what actually occurs when wp_post_delete is trigered

global $wpdb;

$wpdb->query("DELETE FROM wp_posts wpp WHERE wpp.post_type = 'check");
$wpdb->query("DELETE FROM wp_postmeta wppm WHERE wppm.post_id NOT in (SELECT id from wp_posts )");
$wpdb->query("DELETE FROM wp_term_relationships wptr WHERE wptr.object_id NOT in (SELECT id from wp_posts )");

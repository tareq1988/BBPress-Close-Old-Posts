<?php
/*
Plugin Name: bbPress Close Old Posts
Plugin URI: http://tareq.wedevs.com/
Description: Description
Version: 1.0
Author: Tareq Hasan
Author URI: http://tareq.wedevs.com/
License: GPL2
*/

/**
 * Copyright (c) 2015 Tareq Hasan (email: Email). All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * **********************************************************************
 */

// don't call the file directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * BBP_Close_Old_Topics class
 *
 * @class BBP_Close_Old_Topics The class that holds the entire BBP_Close_Old_Topics plugin
 */
class BBP_Close_Old_Topics {

    /**
     * Constructor for the BBP_Close_Old_Topics class
     *
     * Sets up all the appropriate hooks and actions
     * within our plugin.
     *
     * @uses register_activation_hook()
     * @uses register_deactivation_hook()
     * @uses add_action()
     */
    public function __construct() {
        register_activation_hook( __FILE__, array( $this, 'activate' ) );
        register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );

        // Fire the event
        add_action( 'bbpress_close_topics', array( $this, 'close_old_topics' ) );
    }

    /**
     * Initializes the BBP_Close_Old_Topics() class
     *
     * Checks for an existing BBP_Close_Old_Topics() instance
     * and if it doesn't find one, creates it.
     */
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new BBP_Close_Old_Topics();
        }

        return $instance;
    }

    /**
     * Placeholder for activation function
     *
     * Register the event
     */
    public function activate() {
        wp_schedule_event( time(), 'daily', 'bbpress_close_topics' );
    }

    /**
     * Placeholder for deactivation function
     *
     * Clear the scheduled event
     */
    public function deactivate() {
        wp_clear_scheduled_hook( 'bbpress_close_topics' );
    }

    /**
     * Close old topics
     *
     * The default date is 15 days, if you need to change
     * the duration, define it from your `wp-config.php` file.
     *
     * <code>
     * define( 'BBP_CLOSE_TOPIC_DURATION', 30 ); // for 30 days
     * </code>
     *
     * @return void
     */
    function close_old_topics() {
        $duration = defined( 'BBP_CLOSE_TOPIC_DURATION' ) ? BBP_CLOSE_TOPIC_DURATION : 15;
        $offset   = strtotime( '-' . $duration . ' days');

        // Auto close old topics
        $topics_query = array(
            'show_stickies'  => false,
            'parent_forum'   => 'any',
            'post_status'    => 'publish',
            'posts_per_page' => -1
        );

        if ( bbp_has_topics( $topics_query ) ) {

            while( bbp_topics() ) {

                bbp_the_topic();
                $topic_id    = bbp_get_topic_id();
                $last_active = strtotime( get_post_meta( $topic_id, '_bbp_last_active_time', true ) );

                if ( $last_active < $offset ) {
                    bbp_close_topic( $topic_id );
                }
            }
        }
    }

} // BBP_Close_Old_Topics

BBP_Close_Old_Topics::init();
